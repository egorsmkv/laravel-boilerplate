FROM python:3.12-slim

RUN pip install --no-cache-dir pyzmq

WORKDIR /app

COPY . .

EXPOSE 5555

CMD ["python", "/app/server.py"]
