<?php
	require __DIR__ . '/bootstrap.php';
	#require_logined_session();

	use mpyw\Cowitter\Client;

	function getblocklist(){
		$blocklist = array();

		foreach($_SESSION['client']->get('blocks/list')->users as $user){
			$i = count($blocklist);
			$blocklist[$i][0] = $user->name;
			$blocklist[$i][1] = $user->screen_name;
		}
		return $blocklist;
	}


#	$record = ORM::for_table('blocklist')->find_many();
?>
<!DOCTYPE html>
<html lang='en'></html>
<head>
  <meta charset='UTF-8' content='text/html' http-equiv='Content-Type'>
  <meta content='en' http-equiv='Content-Language'>
  <meta content='width=device-width, initial-scale=1, shrink-to-fit=no' name='viewport'>
  <meta content='他人のブロックリスト、手軽に自分のアカウントにインポートしたくない？' name='description'>
  <meta content='onokatio' name='auhthor'>
  <meta content='ブロックリスト共有したった〜' name='application-name'>
  <link crossorigin='anonymous' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css' integrity='sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ' rel='stylesheet'>
  <link href='main.css' rel='stylesheet'>
  <style></style>
  <title>ブロックリスト共有したった〜</title>
</head>
<body>
  <nav class='navbar navbar-toggleable navbar-light bg-faded'>
    <span class='navbar-brand mr-auto'>ブロックリスト共有したった〜</span>
    <form method='POST'>
      <?php if(isset($_SESSION['state'])): ?>
      <input name='logout' type='hidden' value='true'>
      <button class='btn btn-primary' type='submit'>ログアウト</button>
      <?php else: ?>
      <input name='login' type='hidden' value='true'>
      <button class='btn btn-primary' type='submit'>ログイン</button>
      <?php endif ?>
    </form>
  </nav>
  <div class='row m-0 d-flex flex-row flex-wrap' id='about'>
    <span class='my-0 my-sm-0 my-md-0 my-lg-auto my-xl-auto text-center flexitem col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6'>
      ブロックリストを、インポート。<br>
      しかも、ボタン１つで。
    </span>
    <div class='text-right flexitem p-0 col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6'>
      <img src='phone.png'>
    </div>
  </div>
  <div class='row m-0 d-flex flex-row flex-wrap' id='dashboard'>
    <div class='card flexitem col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6' id='register'>
      <div class='card-block'>
        <h4 class='card-title'>ブロックリストを登録</h4>
        <p class='card-text'>
          あなたのブロックリストを登録します。<wbr>
          登録された情報はインターネットに公開されます。<wbr>
          ブロックリストを変更した際も、ここからアップデートできます。
          <small>最終更新: <?= date('Y年m月d日') ?></small>
          <div class='btn-group'>
            <button class='btn btn-outline-primary'>登録する</button>
            <button class='btn btn-outline-danger'>削除する</button>
          </div>
        </p>
      </div>
    </div>
    <div class='card flexitem col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6' id='search'>
      <div class='card-block'>
        <h4 class='card-title'>検索</h4>
        <p class='card-text'>
          他のユーザーのブロックリストを検索できます。<wbr>
          そのユーザーが当サービスにブロックリストを登録していない場合、検索することはできません。
          <div class='input-group'>
            <span class='input-group-addon'>@</span>
            <input class='form-control' name='id' type='text'>
            <span class='input-group-btn'>
              <button class='btn btn-success' type='submit'>検索する</button>
            </span>
          </div>
        </p>
      </div>
    </div>
    <div class='card flexitem col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6' id='userinfo'>
      <div class='card-block'>
        <h4 class='card-title'>あなたの情報</h4>
        <p class='card-text'>
          <table class='table'>
            <tbody>
              <tr>
                <td>名前</td>
                <td><?= $_SESSION['info']->name ?></td>
              </tr>
              <tr>
                <td>アカウント名</td>
                <td>@<?= $_SESSION['info']->screen_name ?></td>
              </tr>
              <tr>
                <td>アカウントID</td>
                <td><?= $_SESSION['info']->id_str ?></td>
              </tr>
              <tr>
                <td>登録ブロック数</td>
                <td>未登録</td>
              </tr>
              <tr>
                <td>ブロックJSON</td>
                <td><?= var_dump($_SESSION['client']->get('blocks/list')) ?></td>
              </tr>
            </tbody>
          </table>
        </p>
      </div>
    </div>
    <div class='card flexitem col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6' id='dbinfo'>
      <div class='card-block'>
        <h4 class='card-title'>データベースの情報</h4>
        <p class='card-text'>
          <table class='table'>
            <tbody>
              <tr>
                <td>登録ブロックリスト数</td>
                <td>0</td>
              </tr>
              <tr>
                <td>ブロックアカウント数</td>
                <td>0</td>
              </tr>
              <tr>
                <td>ブロックしている人数</td>
                <td>平均0</td>
              </tr>
            </tbody>
          </table>
        </p>
      </div>
    </div>
  </div>
</body>
<!-- %footer.text-right -->
<!-- %span Made by onokatio -->
