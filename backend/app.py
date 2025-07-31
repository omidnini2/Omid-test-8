from flask import Flask, request, send_file, jsonify
import os

app = Flask(__name__)

@app.route('/clone', methods=['POST'])
def clone_voice():
    # دریافت فایل صوتی و متن
    voice = request.files.get('voice')
    text = request.form.get('text', '')
    if not voice or not text:
        return jsonify({'error': 'voice and text required'}), 400
    if len(text) > 100000:
        return jsonify({'error': 'text too long'}), 400
    tmp_voice = 'tmp_voice.wav'
    voice.save(tmp_voice)
    # TODO: اجرای TTS و RVC و تولید خروجی واقعی
    # خروجی تست (بوق)
    return send_file('test_beep.wav', mimetype='audio/wav')

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)