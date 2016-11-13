from flask import Flask
from flask_restful import Resource, Api, request
from flask_restful import reqparse
from flaskext.mysql import MySQL
from flask import jsonify
import random 

app = Flask(__name__)
api = Api(app)
mysql = MySQL()

app.config['MYSQL_DATABASE_USER'] = 'root'
app.config['MYSQL_DATABASE_PASSWORD'] = ''
app.config['MYSQL_DATABASE_DB'] = 'delivery'
app.config['MYSQL_DATABASE_HOST'] = 'localhost'

mysql.init_app(app)

@app.route('/')
def hello_world():
    return 'hello world!'

@app.route('/track/', methods=['GET'])
def track():
    vkid = request.args.get('vkid')
    ordernumber=request.args.get('ordernumber')
    conn = mysql.connect()
    cursor = conn.cursor()
    cursor.execute("Select courier.name, courier.surname, order.status, order.date from `order`,`courier` where order.courier_id=courier.id and order.id=%s and order.user_id=%s" %(str(ordernumber),str(vkid)))
    row=cursor.fetchone()
    if cursor.rowcount==1:
        jsn= {
            'Courier_Name': row[0],
            'Courier_Surname': row[1],
            'Status': row[2],
            'Date': row[3]
            }
        conn.close()
        cursor.close()
        return jsonify(jsn)
    else:
        return jsonify({'Message': 'Incorrect surname or order number'})

class NewOrder(Resource):
    def post(self):
        try:
            parser = reqparse.RequestParser()
            parser.add_argument('user_id', type=int)
            parser.add_argument('name', type=str)
            parser.add_argument('date', type=str)
            parser.add_argument('price', type=int)
            parser.add_argument('adress_from', type=str)
            parser.add_argument('adress_to', type=str)
            parser.add_argument('already_paid', type=int)
            args = parser.parse_args()
            _courier_id=random.randint(1,6)
            _user_id=args['user_id']
            _name=args['name']
            _date=args['date']
            _price=random.randint(5000,999999)
            _adress_from=args['adress_from']
            _adress_to=args['adress_to']
            _already_paid=args['already_paid']
            conn=mysql.connect()
            cursor=conn.cursor()
            cursor.callproc('newOrder', (_courier_id, _user_id, _name, _date, _price, _adress_from, _adress_to, 0, _already_paid))
            data = cursor.fetchall()

            if len(data) is 0:
                conn.commit()
                conn.close()
                cursor.close()
                return {'StatusCode':'200','Message': 'Order creation success'}
            else:
                return {'StatusCode':'1000','Message': str(data[0])}
            
        except Exception as e:
            return {'error': str(e)}
api.add_resource(NewOrder, '/NewOrder')
            
class CreateUser(Resource):
    def post(self):
        try:
            parser = reqparse.RequestParser()
            parser.add_argument('vkid', type=int)
            parser.add_argument('name', type=str)
            parser.add_argument('surname', type=str)
            parser.add_argument('photo', type=str)
            args = parser.parse_args()

            _vkid = args['vkid']
            _name = args['name']
            _surname = args['surname']
            _photo= args['photo']


            conn = mysql.connect()
            cursor = conn.cursor()
            cursor.callproc('spCreateUser',(_vkid,_name,_surname,_photo))
            data = cursor.fetchall()

            if len(data) is 0:
                conn.commit()
                conn.close()
                cursor.close()
                return {'StatusCode':'200','Message': 'User creation success'}
            else:
                return {'StatusCode':'1000','Message': str(data[0])}
            
        except Exception as e:
            return {'error': str(e)}

api.add_resource(CreateUser, '/CreateUser')

if __name__=='__main__':
    app.run(debug=True)
