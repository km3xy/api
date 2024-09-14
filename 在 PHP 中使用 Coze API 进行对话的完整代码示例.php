
coze.com的api  token怎么使用

豆包回答





以下是一个改进后的可以接收用户输入并与 Coze API 交互的 PHP 代码示例：
 
php
 复制

<?php

// 设置你的 Bot ID 和 API Token
$botId = 'YOUR_BOT_ID';
$apiToken = 'YOUR_API_TOKEN';

// 设置对话 ID 和用户标识，可以根据实际情况修改
$conversationId = uniqid();
$user = 'unique_user_identifier';

// 获取用户输入
function getUserInput() {
    echo "请输入问题（输入 'exit' 退出）：";
    $input = trim(fgets(STDIN));
    return $input;
}

// 发送请求到 Coze API 的函数
function sendRequestToCoze($query) {
    global $botId, $apiToken, $conversationId;
    $url = "https://api.coze.com/open_api/v2/chat";
    $headers = [
        "authorization: Bearer {$apiToken}",
        "content-type: application/json",
        "accept: */*",
        "host: api.coze.com",
        "connection: keep-alive"
    ];
    $data = [
        'conversation_id' => $conversationId,
        'bot_id' => $botId,
        'user' => $user,
        'query' => $query,
        'stream' => false
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    if ($response === false) {
        echo 'Curl error: '. curl_error($ch). PHP_EOL;
        return null;
    } else {
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpCode === 200) {
            return json_decode($response, true);
        } else {
            echo "请求失败，状态码：$httpCode，错误信息：$response". PHP_EOL;
            return null;
        }
    }
    curl_close($ch);
}

// 主程序循环
while (true) {
    $input = getUserInput();
    if ($input === 'exit') {
        break;
    }
    $responseData = sendRequestToCoze($input);
    if ($responseData) {
        echo "回答：".$responseData['answer']. PHP_EOL;
    }
}




以下是另一个用 PHP 调用 Coze API 进行对话的示例代码：
 
php
 复制
<?php

// 设置你的 Bot ID 和 API Token
$botId = 'YOUR_BOT_ID';
$apiToken = 'YOUR_API_TOKEN';

// 设置对话 ID 和用户标识，可以根据实际情况修改
$conversationId = uniqid();
$user = 'unique_user_identifier';

// 要发送的问题
$query = '你能介绍一下 Coze API 吗？';

// 设置请求的 URL
$url = "https://api.coze.com/open_api/v2/chat";

// 设置请求头部
$headers = [
    "authorization: Bearer {$apiToken}",
    "content-type: application/json",
    "accept: */*",
    "host: api.coze.com",
    "connection: keep-alive"
];

// 设置请求主体数据
$data = [
    'conversation_id' => $conversationId,
    'bot_id' => $botId,
    'user' => $user,
    'query' => $query,
    'stream' => false
];

// 使用 cURL 发送请求
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
if ($response === false) {
    echo 'Curl error: '. curl_error($ch);
} else {
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($httpCode === 200) {
        $result = json_decode($response, true);
        print_r($result);
    } else {
        echo "请求失败，状态码：$httpCode，错误信息：$response";
    }
}
curl_close($ch);

 
 
请记得将代码中的  YOUR_BOT_ID  和  YOUR_API_TOKEN  替换为你实际获取的 Bot ID 和 API Token。
 
这个示例同样使用 cURL 来发送请求，通过设置请求的 URL、头部和主体数据，向 Coze API 发送对话请求，并处理响应结果。你可以根据实际情况调整代码中的参数和处理逻辑。




 
在这个示例中，程序会不断提示用户输入问题，直到用户输入  exit  退出。每次用户输入问题后，程序会调用 Coze API 并打印出回答。请确保将代码中的  YOUR_BOT_ID  和  YOUR_API_TOKEN  替换为你实际的 Bot ID 和 API Token。
