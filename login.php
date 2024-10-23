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

// 로그인 처리
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 사용자 정보 확인
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // 비밀번호 확인
        if (password_verify($password, $row['password'])) {
            echo "로그인 성공!";
            // 로그인 후 할 작업을 여기에 추가
        } else {
            echo "잘못된 비밀번호.";
        }
    } else {
        echo "존재하지 않는 사용자입니다.";
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>로그인 페이지</title>
</head>
<body>
    <h2>로그인</h2>
    <form method="POST" action="">
        사용자 이름: <input type="text" name="username" required><br>
        비밀번호: <input type="password" name="password" required><br>
        <input type="submit" value="로그인">
	<p><a href="index.html">홈으로 가기</a></p>
    </form>
</body>
</html>
