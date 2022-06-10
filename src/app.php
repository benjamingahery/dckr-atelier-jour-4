<?php 
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    die();
}
?>

<?php include __DIR__ . '/templates/header.php'; ?>

      <div class="task task--add">
        <form method="POST">
          <div class="task__content">
            <div class="task__title">
              <p class="task__title-label"></p>
              <input class="task__title-field input" type="text" placeholder="Carottes, poulet, poisson, ..." name="title" />
            </div>
            <div class="task__buttons">
              <button class="task__button task__button--add button is-info">
                <span class="icon is-small">
                  <i class="fa fa-plus"></i>
                </span>
                <span>Ajouter</span>
              </button>
            </div>
          </div>
        </form>
      </div>
      <div class="tasks">

      </div>
    </main>
  </div>

  <template id="taskTemplate">
    <div class="task task--todo">
      <div class="task__content">
        <div class="task__title">
          <p class="task__title-label"></p>
        </div>
        <div class="task__buttons">
          <button class="task__button task__button--validate button is-success is-small">
            <span class="icon is-small">
              <i class="fa fa-check-square-o"></i>
            </span>
          </button>
          <button class="task__button task__button--archive button is-danger is-small">
            <span class="icon is-small">
              <i class="fa fa-trash"></i>
            </span>
          </button>
        </div>
      </div>
    </div>
  </template>

  <script src="assets/js/components/item.js"></script>
  <script src="assets/js/components/itemsList.js"></script>
  <script src="assets/js/components/newItemForm.js"></script>
  <script src="assets/js/app.js"></script>
</body>

</html>