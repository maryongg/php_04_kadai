<header>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="read.php">お見切り一覧</a>
                <?php if($_SESSION["kanri_flg"]== 1){ ?>
                <a class="navbar-brand" href="userlist.php">ユーザー一覧</a>
                <a class="navbar-brand" href="user.php">ユーザー登録</a>
                <?php }?>
                <a class="navbar-brand" href="logout.php">ログアウト</a>
            </div>
        </div>
    </nav>
    <?php echo $_SESSION["name"]; ?>さん
</header>