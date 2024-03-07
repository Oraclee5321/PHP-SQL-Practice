#python -m pip install mysql-connector-python

import mysql.connector
import random
import hashlib
import datetime


first_names = ["Emma", "Liam", "Olivia", "Noah", "Ava", "Isabella", "Sophia",
               "Jackson", "Mia", "Lucas", "Aiden", "Ethan", "Harper", "Evelyn"
               "Abigail", "Benjamin", "Amelia", "Henry", "Charlotte", "Mason",
               "Grace", "Carter", "Madison", "Oliver", "Chloe", "Elijah", "Scarlett",
               "Aria", "Logan", "Ella", "Zoe", "Nathan", "Avery", "Jackson", "Lily",
               "Sebastian", "Mila", "Caleb", "Hannah", "Wyatt", "Aubrey"]

surnames = ["Smith", "Johnson", "Williams", "Jones", "Brown", "Davis", "Miller",
            "Wilson", "Moore", "Taylor", "Anderson", "Thomas", "Jackson", "White",
            "Harris", "Martin", "Thompson", "Garcia", "Martinez", "Robinson","Clark",
            "Lewis", "Walker", "Hall", "Allen", "Young", "Hill", "Wright", "Adams", "King",
            "Baker", "Green", "Turner", "Cooper", "Morris", "Ward", "Mitchell", "Evans", "Collins",
            "Murphy", "Parker"]
streetnames = ["Maple Street", "Main Avenue", "Oak Lane", "Cedar Avenue", "Elm Street", "Pine Road", "Willow Lane",
               "Sycamore Avenue", "Birch Street", "Holly Lane", "Magnolia Avenue", "Cypress Street", "Juniper Lane",
               "Cherry Avenue", "Mulberry Street", "Poplar Lane", "Ash Avenue", "Spruce Street", "Chestnut Lane",
               "Locust Avenue"]
housenames = ["Chateau de Lumière", "Villa Belle Époque", "Casa della Luna", "Manor du Soleil", "Palazzo delle Rose",
              "Chalet Montagnard", "Maison de Charme", "Torre di Amore", "Schloss Vertrauen", "Villa des Vignes", "Haus der Eleganz",
              "Cottage des Chênes", "Domaine de la Brise", "Belle Vue Chalet", "La Casa Fiorita", "Schönes Hügeldach", "Lumière du Lac Maison",
              "Rustique Résidence", "Villa Mare Sereno", "Königlicher Rückzugsort"]

cities = ["London", "Manchester", "Birmingham", "Glasgow", "Liverpool", "Edinburgh", "Bristol", "Leeds",
          "Newcastle upon Tyne", "Cardiff", "Belfast", "Sheffield", "Nottingham", "Southampton", "Aberdeen",
          "Oxford", "Cambridge", "Leicester", "Brighton", "York"]

emails = ["gmail.com","outlook.com","hotmail.com","hotmail.co.uk","yahoo.com","gogomail.com","googlemail.com"]


db = mysql.connector.connect(host = "localhost",
                     user = "admin",
                     password = "123",
                     database = "assignment")

print(db.is_connected())

mycursor = db.cursor()



def Genaddress():
    i = random.getrandbits(1)
    streetname = random.choice(streetnames)
    if i == 0:
        housename = random.choice(housenames)
        return (housename + " " + streetname)
    else:
        hnumber = str(random.randint(1,101))
        return (hnumber + "" + streetname)
    
def Genpostcode():
    post_code = ""
    for x in range(2):
        letter_ascii = random.randint(65, 90)
        post_code += chr(letter_ascii)
    for x in range(2):
        post_code += str(random.randint(0, 9))
    for x in range(2):
        letter_ascii = random.randint(65, 90)
        post_code += chr(letter_ascii)
    return(post_code)

def Genphonenumber():
    phonenum = ""
    for x in range(16):
        phonenum += str(random.randint(0, 16))
    return (phonenum)

def genDOB():
    start_date = datetime.date(1970, 1, 1)
    end_date = datetime.date(2005, 12, 30)
    num_days = (end_date - start_date).days
    rand_days = random.randint(1, num_days)
    random_date = start_date + datetime.timedelta(days=rand_days)
    return(random_date)


def Genpassword(first, last):
    password = ""
    password += first[:3]
    password += last[-3:]
    password += str(random.randint(100, 1000))
    return (password)

def Gensalt(password):
    salt = random.randint(100, 1000)
    password +=str(salt)
    return salt, password

hashing = hashlib.new('sha256')


for x in range(51):
    f_name = random.choice(first_names)
    s_name = random.choice(surnames)
    dob = genDOB()
    address_line_1 = Genaddress()
    city = random.choice(cities)
    postcode = Genpostcode()
    phonenumber = Genphonenumber() 
    IDnum = x + 51
    payment = random.randint(1, 2)
    email = s_name+f_name+"@"+random.choice(emails)
    username = s_name+f_name
    password = Genpassword(f_name, s_name)
    salt,password = Gensalt(password)
    hashing.update(password.encode())
    password = hashing.hexdigest()
    asql = f"INSERT INTO tbl_login(loginUsername, loginEmail, loginPassword, loginSalt) VALUES ('{username}','{email}','{password}','{salt}')"
    mycursor.execute(asql)
    db.commit()
    sql = (f"INSERT INTO tbl_customers"
           f"(customerFName,customerSName,customerDOB,customerAddress,customerCity,customerPostCode,customerPhone,customerLoginID,customerPaymentID) "
           f"VALUES ('{f_name}','{s_name}','{dob}','{address_line_1}','{city}','{postcode}','{phonenumber}', {IDnum}, '{payment}')")
    mycursor.execute(sql)



    


