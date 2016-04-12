<h1>Gestion des travaux</h1>
<table class="table table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Titre</th>
      <th>Type</th>
      <th>Année</th>
      <th>Modifier</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($datas as $key => $data): ?>
      <tr>
        <form method="get">
          <input type="hidden" name="id" value="<?= $data['id']?>">
          <?php foreach ($data as $value): ?>
            <td><?php echo $value ?></td>
          <?php endforeach; ?>
          <td><button type="submit"class="btn btn-info" formaction="/admin/modifier">Modifier</button><button type="submit" class="btn btn-danger"formaction="/admin/delete">Eliminer</button></td>
        </form>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
