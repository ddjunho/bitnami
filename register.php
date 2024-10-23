<?php
// 데이터베이스 연결 설정
$host = 'localhost';
$db = 'my_database';
$user = 'root';
$pass = 'U3DYRePeDDr:'; // Bitnami에서 설정한 비밀번호로 변경하세요.

$conn = new mysqli($host, $user, $pass, $db);

// 연결 확인
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

// 사용자 등록 처리
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password']; 

    // 사용자 추가
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        echo "사용자가 등록되었습니다!";
    } else {
        echo "사용자 등록 실패: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>회원가입 페이지</title>
</head>
<body>
    <h2>회원가입</h2>
    <form method="POST" action="">
        사용자 이름: <input type="text" name="username" required><br>
        비밀번호: <input type="password" name="password" required><br>
        <input type="submit" value="가입하기">

    </form>
	<p><a href="index.html">홈으로 가기</a></p>
</body>
</html>

	
