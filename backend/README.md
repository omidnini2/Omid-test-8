# راهنمای نصب و اجرای بخش هوش مصنوعی (backend)

این بخش شامل دو قسمت است:

1. **RVC WebUI** برای کلون‌کردن صدا
2. **Coqui TTS** برای تبدیل متن به گفتار فارسی

## پیش‌نیازها
- پایتون ۳.۸ یا بالاتر
- کارت گرافیک (GPU) برای سرعت بهتر (اختیاری)
- pip

## نصب RVC WebUI

```bash
git clone https://github.com/RVC-Project/Retrieval-based-Voice-Conversion-WebUI.git
cd Retrieval-based-Voice-Conversion-WebUI
pip install -r requirements.txt
```

## نصب Coqui TTS

```bash
pip install TTS
```

## دانلود مدل فارسی TTS

مدل‌های فارسی را می‌توانید از [HuggingFace](https://huggingface.co/) جستجو و دانلود کنید. مثال:

```bash
wget https://huggingface.co/ali-tts/farsi-tts-model/resolve/main/model.pth -O model.pth
```

## آموزش و اجرای مدل‌ها
- برای آموزش مدل کلون صدا، حداقل ۵ دقیقه صدای کاربر نیاز است.
- خروجی TTS را به RVC بدهید تا صدای کلون‌شده تولید شود.

## اجرای سرور

برای تست محلی:
```bash
python app.py
```

توضیحات بیشتر و کد نمونه در همین پوشه قرار می‌گیرد.