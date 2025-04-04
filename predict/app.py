from flask import Flask, request, jsonify
import pickle
import numpy as np

app = Flask(__name__)

# Load the trained model
model = pickle.load(open("svc.pkl", "rb"))

@app.route('/predict', methods=['POST'])
def predict():
    data = request.get_json()
    symptoms = data.get("symptoms", "")

    # Convert input into model format (modify as per dataset)
    input_data = np.array([symptoms])  # Adjust processing here
    prediction = model.predict(input_data)

    response = {
        "disease": prediction[0],
        "medicines": ["Medicine1", "Medicine2", "Medicine3"]  # Replace with actual lookup
    }
    return jsonify(response)

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True)
