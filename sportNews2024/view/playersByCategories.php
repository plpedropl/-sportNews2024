<!-- Страница вывода новостей по категориям -->
<?php
    ob_start();
?>


<style>
    .card-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 20px;
    }

    .card {
        width: calc(25% - 20px); /* 25% ширины экрана с учетом отступов */
        max-width: 400px; /* Максимальная ширина карточки */
        height: auto; /* Автоматическая высота */
        margin: 10px; /* Уменьшенный отступ между карточками */
    }

    @media screen and (max-width: 992px) {
        .card {
            width: calc(33.33% - 20px); /* 33.33% ширины экрана с учетом отступов */
        }
    }

    @media screen and (max-width: 768px) {
        .card {
            width: calc(50% - 20px); /* 50% ширины экрана с учетом отступов */
        }
    }

    @media screen and (max-width: 576px) {
        .card {
            width: calc(100% - 20px); /* 100% ширины экрана с учетом отступов */
        }
    }
</style>

<?php
    ob_start();
?>

<?php 
    if(isset($playersByCategories) && $playersByCategories) {
        echo '<div>
        <h1 style="text-align: center; margin-top: 120px;">'.$category['title'].'</h1>
        <hr style="width: 70%; margin-left: 15%;"></hr>';
        echo '<div class="card-container">';
        $counter = 0;
        foreach ($playersByCategories as $players) {
          if ($counter % 4 == 0) {
              echo '</div><div class="card-container">';
          }
          echo '<div class="card">';
          echo '  <div class="card-imageplayer">';
          // Добавляем класс "football-image" для картинок в категории "футбол"
          echo '      <img src="' . $players['image'] . '" alt="" class="card-imgplayer' . ($category['title'] == 'футбол' ? ' football-image' : '') . '">';
          echo '  </div>';
          echo '  <div class="card-content">';
          echo '      <h2 class="firstname">' . $players['firstname'] . ' ' . $players['lastname'] . '</h2>';
          echo '      <p class="description" style="font-size: 16px;">' . $players['description'] . '</p>';
          echo '      <p class="description" style="font-size: 16px; color: #555;">Возраст: ' . $players['age'] . '</p>';
            // Помещаем кнопки внизу карточки
            echo '  </div>'; // Закрываем <div class="card-content">
            if(isset($_SESSION['role']) && ($_SESSION['role'] == "admin" || $_SESSION['role'] == "manager")){
                echo '<div style="display: flex; justify-content: center; margin-top: 15px; height: 100%; align-items: flex-end; margin-bottom: 15px;">';
                echo '  <div style="margin-right: 10px;">';
                echo '    <button type="button" class="btn btn-success btn-sm edit-btn" data-toggle="modal" data-target="#editPlayersModal" data-players-id="'.$players['id'].'" data-playersfirstname="' . $players['firstname'] .'" data-playerslastname="' . $players['lastname'] .  '" data-playersdescription="' . $players['description'] . '" data-playersimage="' . $players['image'] . '" data-playersage="' . $players['age'] . '">Изменить</button>';
                echo '  </div>';
                echo '  <div>';
                echo '    <button type="button" class="btn btn-danger btn-sm delete-btn" data-toggle="modal" data-target="#deletePlayersModal" data-players-id="' . $players['id'] .'" >Удалить</button>';
                echo '  </div>';
                echo '</div>';
            }
            echo '</div>';
            $counter++;
        }
        echo '</div>';
        echo '</div>';
    } else {
        echo '<div><h2 style="text-align: center;">Нет данных</h2></div>';
    }
?>

<div class="modal fade" id="editPlayersModal" tabindex="-1" role="dialog" aria-labelledby="editPlayersModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editPlayersModalLabel">Изменение игрока</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Форма для изменения игрока -->

        <form class="form-signin" action="editplayersresult?<?php echo $category['id']; ?>" method="POST">
          <input type="hidden" name="playersId" value="">
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
            <label for="categoriesSelect">Выберите категорию:</label>
            <select name="categoriesSelect" class="form-control" id="categoriesSelect">
              <?php
                foreach ($allcategories as $categories) {
                  echo '<option value="'.$categories['id'].'" >'.$categories['title'].'</option>';
                  }
              ?>
            </select>   
          </div>
          <button name="send" type="submit" class="btn btn-primary">Изменить игрока</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deletePlayersModal" tabindex="-1" role="dialog" aria-labelledby="deletePlayersModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deletePlayersModalLabel">Удаление игрока</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Вы действительно хотите удалить игрока?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Нет</button>
        <form action="deleteplayersbycategoriesresult?<?php echo $searchQuery ?>" method="POST">
          <input type="hidden" name="playersId" value="">
          <button name="send" type="submit" class="btn btn-danger">Да</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>

  $('.edit-btn').on('click', function() {
      var playersId = $(this).data('players-id');
      var playersFirstname = $(this).data('playersfirstname');
      var playersLastname = $(this).data('playerslastname');
      var playersDescription = $(this).data('playersdescription');
      var playersImage = $(this).data('playersimage');
      var playersAge = $(this).data('playersage');

      $('#editPlayersModal input[name="playersId"]').val(playersId);
      $('#editPlayersModal input[name="playersFirstname"]').val(playersFirstname);
      $('#editPlayersModal input[name="playersLastname"]').val(playersLastname);
      $('#editPlayersModal input[name="playersDescription"]').val(playersDescription);
      $('#editPlayersModal input[name="playersImage"]').val(playersImage);
      $('#editPlayersModal input[name="playersAge"]').val(playersAge);

  });

  $('.delete-btn').on('click', function() {
      var playersId = $(this).data('players-id');

      $('#deletePlayersModal input[name="playersId"]').val(playersId);

  });
  
</script>



<?php
    $content = ob_get_clean();
    include "view/templates/layout.php";
?>






