import socket
import requests
import json


##CREDENCIAIS PARA MUDAR
URL = "http://localhost"
TOKEN = "MEU_TOKEN"


def get_ip_address():
    try:
        sock = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
        sock.connect(("8.8.8.8", 80))
        ip_address = sock.getsockname()[0]
        sock.close()
        
        return ip_address
    
    except socket.error:
        return False
    

def make_api_request(ip=None):

    try:
        payload = {
            "ip": ip
        }

        headers = {
            "Content-Type": "application/json",
            "Authorization": "Bearer " + TOKEN
        }

        json_payload = json.dumps(payload)
        response = requests.post(URL + "/api/checkip", data=json_payload, headers=headers)

        if response.status_code == 200:
            data = response.json()
            return True
        else:
            return False

    except requests.RequestException as e:
        return False


ip = get_ip_address()

if ip == False:
    print(False)

api_data = make_api_request(ip)

print(api_data)
