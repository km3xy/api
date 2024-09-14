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







如何设置 conversation_id？


conversation_id  可以根据你的需求进行灵活设置，以下是一些常见的设置方法：
 
一、使用随机生成的值
 
可以使用 Python 的内置模块如  uuid  来生成一个唯一的标识符作为  conversation_id 。
 
python
 复制
import uuid

conversation_id = str(uuid.uuid4())
 
 
每次生成的 UUID 都是几乎不可能重复的，适合为每个新的对话创建一个唯一的标识。
 
二、基于时间戳
 
利用当前时间戳作为  conversation_id  的一部分，再结合其他字符或数字生成一个相对唯一的值。
 
python
 复制
import time

timestamp = str(int(time.time()))
# 可以进一步加上其他字符或数字组成 conversation_id
conversation_id = f"my_conversation_{timestamp}"
 
 
三、自定义规则
 
根据特定的业务逻辑或规则来生成  conversation_id 。例如，如果是为不同的用户创建对话，可以结合用户 ID 和一个计数器。
 
python
 复制
user_id = "12345"
conversation_counter = 1
conversation_id = f"{user_id}_{conversation_counter}"
conversation_counter += 1
 
 
四、使用数据库生成的唯一 ID（如果有数据库支持）
 
如果你的应用有数据库支持，可以在数据库中创建一个表来存储对话信息，并让数据库自动生成一个唯一的 ID 作为  conversation_id 。每次创建新对话时，从数据库中获取这个唯一 ID。
 
需要注意的是，无论采用哪种方式，要确保  conversation_id  在你的应用场景中具有足够的唯一性，以便能够准确地识别和管理不同的对话。









