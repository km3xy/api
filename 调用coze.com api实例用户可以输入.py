以下是添加了用户输入功能的代码：
 
python
 复制

import requests

# 替换为你自己的 Bot ID 和 API Token
bot_id = "YOUR_BOT_ID"
api_token = "YOUR_API_TOKEN"
url = "https://api.coze.com/open_api/v2/chat"

headers = {
    "authorization": f"Bearer {api_token}",
    "content-type": "application/json",
    "accept": "*/*",
    "host": "api.coze.com",
    "connection": "keep-alive"
}

while True:
    # 获取用户输入
    query = input("请输入问题（输入 'exit' 退出）：")
    if query == 'exit':
        break

    data = {
        "conversation_id": "123",  # 这里的 conversation_id 可以根据你的需求自定义
        "bot_id": bot_id,
        "user": "123333333",  # 用户标识，可自定义
        "query": query,
        "stream": False  # 根据实际需求设置是否流式传输
    }

    response = requests.post(url, headers=headers, json=data)

    if response.status_code == 200:
        result = response.json()
        print(result)
    else:
        print(f"请求失败，状态码：{response.status_code}，错误信息：{response.text}")
