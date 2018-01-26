<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Driver_ID</th>
      <th scope="col">Status</th>
      <th scope="col">First Date</th>
      <th scope="col">Finish Date</th>
    </tr>
  </thead>
  <tbody>

  <?php foreach ($contracts as $contract): ?>
    <tr>
      <td><? echo $contract->id?></td>
      <td><? echo $contract->driver_id?></td>
      <td><? echo $contract->status?></td>
      <td><? echo $contract->first_date?></td>
      <td><? echo $contract->second_date?></td>
    </tr>
  <?endforeach;?>

  </tbody>
</table>