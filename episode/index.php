<?php 
  require_once 'func.php' ;
  // database
  $username = 'root';
  $password = '';
  $pdo = new PDO('mysql:host=localhost;dbname=episode;charset=UTF8;', $username, $password);
  $stmt = $pdo->prepare('select * from contents where id = ?');
  $stmt->bindValue(1, $episode, PDO::PARAM_INT);
  $stmt->execute();
  $records = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="ja">
<?php foreach ($records as $record): ?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo $record[1]; ?>｜第<?php echo $record[0]; ?>話｜OnePiece</title>
</head>
<body>
  <p><?php echo date('Y年n月j日',  strtotime($date)); ?>のONE PIECE</p>
  
  <dl>
    <dt>第<?php echo $record[0]; ?>話</dt>
    <dd><?php echo $record[1]; ?></dd>
  </dl>
  <p>発売日：<?php echo date('Y年n月j日',  strtotime($record[2])); ?></p>
  <button onclick="history.back()">戻る</button>
</body>
<?php endforeach; ?>
</html>