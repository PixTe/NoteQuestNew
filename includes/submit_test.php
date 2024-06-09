<?php
require_once 'check_session.php';
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $userId = $_SESSION['user_id'];
    $testId = $_POST['test_id'];
    $answers = $_POST;

    $pdo = pdo();

    $correctAnswers = 0;
    $totalQuestions = count($answers) - 1; // Exclude test_id
    $results = [];

    foreach ($answers as $questionKey => $answerId) {
        if (strpos($questionKey, 'question_') !== 0) {
            continue; // Skip test_id or other unrelated fields
        }

        $questionId = str_replace('question_', '', $questionKey);
        $stmt = $pdo->prepare('SELECT is_correct FROM Answers WHERE id = ?');
        $stmt->execute([$answerId]);
        $answer = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($answer && $answer['is_correct']) {
            $correctAnswers++;
            $results[$questionId] = true; // Mark question as correct
        } else {
            $results[$questionId] = false; // Mark question as incorrect
        }
    }

    $score = ($correctAnswers / $totalQuestions) * 100;

    echo json_encode(['success' => true, 'score' => $score, 'results' => $results]);
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
}
?>
