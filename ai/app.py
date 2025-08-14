from fastapi import FastAPI, Request
import requests

app = FastAPI()

@app.post("/chat")
async def chat(request: Request):
    data = await request.json()
    messages = data.get("messages", [])
    text_prompt = ""

    for msg in messages:
        role = msg.get("role")
        content = msg.get("content", "")
        if role == "system":
            text_prompt += f"[Hệ thống]: {content}\n"
        elif role == "user":
            text_prompt += f"Người dùng: {content}\n"

    try:
        ollama_response = requests.post(
            "http://localhost:11434/api/generate",
            json={
                "model": "llama3",
                "prompt": text_prompt,
                "stream": False
            }
        )
        ollama_response.raise_for_status()
        data = ollama_response.json()

        result = data.get("response", "").strip()

        if not result:
            result = "⚠️ AI không trả lời. Vui lòng thử lại sau."

    except Exception as e:
        result = f"❌ Lỗi khi gọi mô hình: {str(e)}"

    return {"answer": result}

# *********************************
# from fastapi import FastAPI, Request
# import requests

# app = FastAPI()

# @app.post("/chat")
# async def chat(request: Request):
#     data = await request.json()
#     messages = data.get("messages", [])
#     text_prompt = ""

#     for msg in messages:
#         if msg.get("role") == "system":
#             text_prompt += f"[Hệ thống]: {msg['content']}\n"
#         elif msg.get("role") == "user":
#             text_prompt += f"Người dùng: {msg['content']}\n"

#     try:
#         response = requests.post(
#             "http://localhost:11434/api/generate",
#             json={
#                 "model": "llama3",
#                 "prompt": text_prompt,
#                 "stream": False
#             }
#         )
#         response.raise_for_status()
#         result = response.json().get("response", "")
#     except Exception as e:
#         result = f"Lỗi khi gọi mô hình: {str(e)}"

#     return {"answer": result.strip()}

