	<div id="admin-main-content-books">
		<h1>Boeken</h1>
		<div id="UsersTable">
			<?php
				$query = "SELECT * FROM Books";
				$sth = $conn->query($query);
				if($sth->rowCount() > 0)
				{
					$data = $sth->fetchAll();

					echo '<table>
						<tr>
						<th>ID</th>
						<th class="field2 book">ISBN</th>
						<th class="field2 book">Titel</th>
						<th class="field2 book">Aantal</th>
						</tr>';

					foreach($data as $row)
					{
						echo '<tr>
								<td>'.$row["BookID"].'</td>
								<td>'.$row["BookISBN"].'</td>
								<td>'.$row["BookTitle"].'</td>
								<td>'.$row["BookAmount"].'</td>
							</tr>';
					}

					echo '</table>';
				}
				else{
					echo '<p>Er zijn geen gebruikers beschikbaar</p>';
				}

			?>
		</div>
		<p>Gebruiker toevoegen klik
			<a href="javascript:void(0)" onclick="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">hier.</a>
		</p>
		<div id="light" class="white_content">
			<p>Gebruiker toevoegen</p> 

			<a href="javascript:void(0)" onclick="document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">Sluit.</a>
		</div>
		<div id="fade" class="black_overlay">
			
		</div>
		<div id="copyright">
			<p>&copy; ScanYours-Arnhem</p>
		</div>
	</div>