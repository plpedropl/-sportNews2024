<?php
ob_start();
?>
<div style=" margin-top: 70px;">
    <h1 style="text-align: center;">Турниры</h1>
    <hr style="width: 70%; margin-left: 15%;">
    </hr>
</div>
<!-- Пример HTML-кода для списка категорий спорта и турниров -->
<div style="width: 100%; display: flex; flex-wrap: wrap; justify-content: center; text-align: center; margin: auto;">

    <div id="sport-categories">
        <!-- Картинки для выбора категории -->
        <?php
        foreach ($allcategories as $category) {
            echo '<a href="tournaments?id=' . $category['id'] . '">';
            echo  '<img src="images/' . $category['icons'] . '" alt="' . $category['title'] . '" title="' . $category['title'] . '" data-category="' . $category['title'] . '">';
            echo '</a>';
        }
        ?>
    </div>
    <?php if (isset($select_tour) && count($select_tour) > 0) {  ?>
        <ul style="width: 100%;" id="tournament-list">
            <?php
            foreach ($select_tour as $tour)
                echo '<li><a href="tourdetail?id=' . $tour['id'] . '" >' . $tour['title'] . '</a></li>';
            ?>

        </ul>
    <?php     }    ?>

    <?php if (isset($select_tour_detail) && count($select_tour_detail) > 0) {
    foreach ($select_tour_detail as $tourdetail) {
        if ($tourdetail['result'] == null) $tourdetail['result'] = "- : -";
        echo '
            <div class="tournament-details-container">
                <p>Дата: ' . $tourdetail['date'] . '</p>
                <p>' . $tourdetail['cl1'] . '<img src="images/' . $tourdetail['ban1'] . '" title="' . $tourdetail['country'] . '"> ' . $tourdetail['result'] . ' <img src="images/' . $tourdetail['ban2'] . '" title="' . $tourdetail['country2'] . '"> ' . $tourdetail['cl2'] . '</p>
                <p>Место проведения: ' . $tourdetail['location'] . '</p>';
        // Проверка роли пользователя и вывод кнопок "Изменить" и "Удалить"
        if (isset($_SESSION['role']) && ($_SESSION['role'] == "admin" || $_SESSION['role'] == "manager")) {
            echo '
                <div style="margin-top: 10px;">
                    <button type="button" class="btn btn-success btn-sm edit-btn" data-toggle="modal" data-target="#editMatchForm" data-match-id="' . $tourdetail['id'] . '" data-date="' . $tourdetail['date'] . '" data-location="' . $tourdetail['location'] . '" data-result="' . $tourdetail['result'] . '">Изменить</button>
                    <button type="button" class="btn btn-danger btn-sm delete-btn" data-toggle="modal" data-target="#deleteMatchModal" data-match-id="' . $tourdetail['id'] . '">Удалить</button>
                </div>';
        }
        echo '</div>';
    }
}
?>
</div>

<div class="modal fade" id="editMatchForm" tabindex="-1" role="dialog" aria-labelledby="editMatchFormLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editMatchFormLabel">Редактирование матча</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Форма для редактирования матча -->
        <form method="POST" action="profileEditMatch?<?php echo $id; ?>">
        <input type="hidden" name="matchId" value="">
          <!-- Здесь нужно вставить поля, соответствующие редактированию матча -->
          <div class="form-group">
            <label for="editMatchDate" class="control-label">Дата</label>
            <input type="datetime-local" class="form-control" id="MatchDate" name="MatchDate" required>
          </div>
          <div class="form-group">
            <label for="editMatchVenue" class="control-label">Место проведения</label>
            <input type="text" class="form-control" id="MatchVenue" name="MatchVenue" required >
          </div>
      
          <div class="form-group">
            <label for="score" class="control-label">Счет</label>
            <input type="text" class="form-control" id="score" name="score" required>
          </div>
        
          <!-- Аналогично вставьте остальные поля для редактирования матча -->
          <button name="send" type="submit" class="btn btn-primary">Сохранить</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteMatchModal" tabindex="-1" role="dialog" aria-labelledby="deleteMatchModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteMatchModalLabel">Удаление матча</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Вы действительно хотите удалить этот матч?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Нет</button>
        <form method="POST" action="matchDeleteResult? <?php echo $id; ?>">
          <input type="hidden" name="matchId" value="">
          <button name="send" type="submit" class="btn btn-danger">Да</button>
        </form>
      </div>
    </div>
  </div>
</div>


<script>
  $('.edit-btn').on('click', function() {
      var id = $(this).data('match-id');
      var MatchDate = $(this).data('date');
      var MatchVenue = $(this).data('location');
      var score = $(this).data('result');

      $('#editMatchForm input[name="matchId"]').val(id);
      $('#editMatchForm input[name="MatchDate"]').val(MatchDate);
      $('#editMatchForm input[name="MatchVenue"]').val(MatchVenue);
      $('#editMatchForm input[name="score"]').val(score);

  });

  $('.delete-btn').on('click', function() {
      var id = $(this).data('matchId');

      $('#deleteMatchModal input[name="matchId"]').val(id);

  });
</script>

<?php
$content = ob_get_clean();
include "view/templates/layout.php";
?>