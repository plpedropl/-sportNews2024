<!--  Страница после успешного входа в аккаунт -->
<?php 
	ob_start();  
?>
<div class="container">
	<div class="col-sm-12" >
    <div class="content" style="margin-bottom: 70px;margin-right: 180px;">
        <?php
        if ($_SESSION['role'] == "admin") {
            echo '<h1>Добро пожаловать,  <span>' . $_SESSION['name'] . '</span></h1>';
        } else {
            echo '<h1>Добро пожаловать,  <span>' . $_SESSION['name'] . '</span></h1>';
        }
        ?>
</div>
		<!-- раздел информации - данные пользователя, поле пароль - информационно -->
		<div class="row" >
			<div class="col-sm-5">
				<h4>Имя:</h4>
				<h4>Почта:</h4>						
				<h4>Пароль:</h4>
			</div>
			<div class="col-sm-3">
				<h4><?php echo $_SESSION['name']; ?></h4>
				<h4><?php echo $_SESSION['email']; ?></h4>					
				<h4>**********</h4>
			</div>
			<div class="col-sm-2">
				<button class="btn btn-primary btn-black" href="#" style="margin-bottom: 20px;" id="editusername" data-toggle="modal" data-target="#edituser">Поменять имя</button>
				<button class="btn btn-primary btn-black" href="#" style="margin-bottom: 20px;" id="editpost" data-toggle="modal" data-target="#editpostModal">Поменять почту</button>
				<button class="btn btn-primary btn-black" href="#" style="margin-bottom: 20px;" id="editpassword" data-toggle="modal" data-target="#editpass">Поменять пароль</button>
			</div>
			<div>
				<?php 
					if ($_SESSION['role'] != "admin") {
						echo '<button class="btn btn-primary btn-black" href="#" style="margin-top: 20px; margin-left: 20px;" data-toggle="modal" data-target="#deleteProfileModal">Удалить аккаунт</button>';
					}
					if ($_SESSION['role'] == "admin") {
						echo '<button class="btn btn-primary btn-black" style="margin-top: 20px; margin-left: 20px;" data-toggle="modal" data-target="#changeRoleUsersModal">Изменить роль пользователям</button>';
					}
					if($_SESSION['role'] == "admin" or $_SESSION['role'] == "manager"){
						echo '<button class="btn btn-primary btn-black" href="#" style="margin-top: 20px; margin-left: 20px;" data-toggle="modal" data-target="#addNewsForm">Добавить новость</button>';
						echo '<button class="btn btn-primary btn-black" href="#" style="margin-top: 20px; margin-left: 20px;" data-toggle="modal" data-target="#addPlayersForm">Добавить игрока</button>';
            echo '<button class="btn btn-primary btn-black" href="#" style="margin-top: 20px; margin-left: 20px;" data-toggle="modal" data-target="#addMatchForm">Добавить матч</button>';
					}
				?>
			</div>
		</div>
		<!-- answer change - комментарий к выполнению изменения пароля -->
      <div class="row" id="answer">
        <div class="col-sm-10" style="text-align: center; margin-top: 20px;">
          <p style="font-size: 16px;color: green;">Вы успешно вошли в аккаунт</p>
        </div>
      </div>
	</div>	

	<!--  форма для ввода нового пароля   -->
	<div class="modal fade" id="editpass" tabindex="-1" role="dialog" aria-labelledby="editpassLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editpassLabel">Поменять пароль</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="profileEditPassword">
          <div class="form-group">
            <label for="newPassword">Новый пароль</label>
            <input type="password" class="form-control" id="newPassword" name="newPassword" required>
          </div>
          <div class="form-group">
            <label for="confirmPassword">Подтвердите пароль</label>
            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
          </div>
          <button name="send" type="submit" class="btn btn-primary">Сохранить</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editpostModal" tabindex="-1" role="dialog" aria-labelledby="editpostModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editpostModalLabel">Поменять почту</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="profileEditEmail">
          <div class="form-group">
            <label for="confirmEmail" class="control-label">Подтвердите адрес почты</label>
            <input type="email" class="form-control" name="confirmEmail" required>
          </div>
          <div class="form-group">
            <label for="newEmail" class="control-label">Введите новый адрес почты</label>
            <input type="email" class="form-control" name="newEmail" required>
          </div>
          <button name="send" type="submit" class="btn btn-primary">Сохранить</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteProfileModal" tabindex="-1" role="dialog" aria-labelledby="deleteProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteProfileModalLabel">Действительно хотите удалить аккаунт?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <!-- Кнопка для закрытия модального окна -->
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
        <!-- Форма для подтверждения удаления профиля -->
        <form method="POST" action="profileDeletion">
          <button name="send" type="submit" class="btn btn-primary">Да</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addPlayersForm" tabindex="-1" role="dialog" aria-labelledby="addPlayersFormLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addPlayersFormLabel">Добавление игрока</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Форма для добавления игрока -->
        <form method="POST" action="profileAddPlayers">
          <div class="form-group">
            <label for="playersFirstname" class="control-label">Введите имя</label>
            <input type="text" class="form-control" id="playersFirstname" name="playersFirstname" required>
          </div>
          <div class="form-group">
            <label for="playersLastname" class="control-label">Введите фамилию</label>
            <input type="text" class="form-control" id="playersLastname" name="playersLastname" required>
          </div>
          <div class="form-group">
            <label for="playersAge" class="control-label">Введите возраст</label>
            <input type="text" class="form-control" id="playersAge" name="playersAge" required>
          </div>
          <div class="form-group">
            <label for="playersDescription" class="control-label">Описание игрока</label>
            <input type="text" class="form-control" id="playersDescription" name="playersDescription" required>
          </div>
          <div class="form-group">
            <label for="playersImage" class="control-label">Ссылка на изображение</label>
            <input type="text" class="form-control" id="playersImage" name="playersImage">
          </div>
          <div class="form-group">
            <label for="playersCategory" class="control-label">Выберите категорию</label>
            <select name="categoriesSelect" class="form-control">
				<?php 
					foreach ($allcategories as $categories) {
					echo '<option value="'.$categories['id'].'" >'.$categories['title'].'</option>';
					}
				?>
			</select>
          </div>
          <button  name="send" type="submit" class="btn btn-primary">Добавить игрока</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="changeRoleUsersModal" tabindex="-1" role="dialog" aria-labelledby="changeRoleUsersModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeRoleUsersModalLabel">Изменение ролей пользователей<span class="extra-title muted"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form-horizontal">
                <form method="POST" action="profileChangeRole" >
                    <label class="control-label">Выберите пользователя</label>    
                    <select name="user" class="form-control">
                        <?php
                            foreach ($users as $user) {
                                if ($user['role'] == "admin") {
                                    continue;
                                }
                                echo '<option value="'.$user['id'].'" >'.$user['email'].'</option>';
                            }
                        ?>
                    </select>
                    <div class="control-group">    
                        <label class="control-label">Выберите роль</label>    
                        <select name="roleSelect" class="form-control">
                            <option value="manager">Manager</option>
                            <option value="user">User</option>
                        </select>        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        <button name="send" type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="addNewsForm" tabindex="-1" role="dialog" aria-labelledby="addNewsFormLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addNewsFormLabel">Добавление новости</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Форма для добавления новости -->
        <form method="POST" action="profileAddNews">
          <div class="form-group">
            <label for="newsTitle" class="control-label">Заголовок новости</label>
            <input type="text" class="form-control" id="newsTitle" name="newsTitle" required>
          </div>
          <div class="form-group">
            <label for="newsDescription" class="control-label">Описание новости</label>
            <input type="text" class="form-control" id="newsDescription" name="newsDescription" required>
          </div>
          <div class="form-group">
            <label for="newsImage" class="control-label">Ссылка на изображение</label>
            <input type="text" class="form-control" id="newsImage" name="newsImage">
          </div>
          <div class="form-group">
            <label for="newsCategory" class="control-label">Выберите категорию</label>
            <select name="categoriesSelect" class="form-control">
				<?php 
					foreach ($allcategories as $categories) {
					echo '<option value="'.$categories['id'].'" >'.$categories['title'].'</option>';
					}
				?>
			</select>
          </div>
          <button  name="send" type="submit" class="btn btn-primary">Добавить новость</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addMatchForm" tabindex="-1" role="dialog" aria-labelledby="addMatchFormLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addMatchFormLabel">Добавление матча</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Форма для добавления матча -->
        <form method="POST" action="profileAddMatch">
          <div class="form-group">
            <label for="matchDate" class="control-label">Дата</label>
            <input type="datetime-local" class="form-control" id="matchDate" name="matchDate" required>
          </div>
          <div class="form-group">
            <label for="matchVenue" class="control-label">Место проведения</label>
            <input type="text" class="form-control" id="matchVenue" name="matchVenue" required>
          </div>
          <div class="form-group">
            <label for="club1" class="control-label">Клуб 1</label>
            <select name="club1" class="form-control">
            <?php 
              foreach ($allclubs as $club) {
              echo '<option value="'.$club['id'].'" >'.$club['title'].'</option>';
              }
            ?>
          </select>
          </div>
          <div class="form-group">
            <label for="club2" class="control-label">Клуб 2</label>
            <select name="club2" class="form-control">
            <?php 
              foreach ($allclubs as $club) {
              echo '<option value="'.$club['id'].'" >'.$club['title'].'</option>';
              }
            ?>
          </select>
          </div>
          <div class="form-group">
            <label for="score" class="control-label">Счет</label>
            <input type="text" class="form-control" id="score" name="score" required>
          </div>
          <div class="form-group">
            <label for="winnerClub" class="control-label">Победитель</label>
            <select name="winnerClub" class="form-control">
            <?php 
              foreach ($allclubs as $club) {
              echo '<option value="'.$club['id'].'" >'.$club['title'].'</option>';
              }
            ?>
          </select>
          </div>
          <div class="form-group">
            <label for="matchCategory" class="control-label">Выберите категорию</label>
            <select name="tournamentsSelect" class="form-control">
            <?php 
              foreach ($alltournaments as $tournaments) {
              echo '<option value="'.$tournaments['id'].'" >'.$tournaments['title'].'</option>';
              }
            ?>
          </select>
          </div>
          <button  name="send" type="submit" class="btn btn-primary">Добавить матч</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="edituser" tabindex="-1" role="dialog" aria-labelledby="edituserLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edituserLabel">Поменять имя</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="profileEditUsername">
          <div class="form-group">
            <label for="confirmUsername">Введите новое имя</label>
            <input type="text" class="form-control" id="confirmUsername" name="confirmUsername" required>
          </div>
          <button name="send" type="submit" class="btn btn-primary">Сохранить</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
</div>

 
<?php 
	$content = ob_get_clean(); 
	include "view/templates/layout.php";
?>	
	