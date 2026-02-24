from flask import Flask, request, jsonify
from flask_cors import CORS
import random

app = Flask(__name__)
CORS(app)

# Demo users (ONLY THESE CAN LOGIN)
USERS = {
    "abin": "1234",
    "ashitta": "1234567",
    "carolin": "123456789",
    "dhanusha": "12345678"
}

# Store OTP temporarily
otp_store = {}

@app.route("/login", methods=["POST"])
def login():
    data = request.json
    username = data.get("username")
    password = data.get("password")

    if username in USERS and USERS[username] == password:
        otp = random.randint(100000, 999999)
        otp_store[username] = otp

        return jsonify({
            "status": "success",
            "message": "Login successful",
            "otp": otp   # shown only for demo
        })

    return jsonify({
        "status": "failed",
        "message": "Invalid username or password"
    }), 401


@app.route("/verify-otp", methods=["POST"])
def verify_otp():
    data = request.json
    username = data.get("username")
    otp = data.get("otp")

    if username in otp_store and str(otp_store[username]) == str(otp):
        return jsonify({
            "status": "success",
            "message": "OTP verified"
        })

    return jsonify({
        "status": "failed",
        "message": "Invalid OTP"
    }), 401


if __name__ == "__main__":
    app.run(debug=True)
