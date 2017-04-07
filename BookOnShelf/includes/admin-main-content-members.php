	<div id="admin-main-content-members">
		<h1>Gebruikers</h1>
		<div id="UsersTable">
			<?php
				$query = "SELECT * FROM Members";
				$sth = $conn->query($query);
				if($sth->rowCount() > 0)
				{
					$data = $sth->fetchAll();

					echo '<table>
						<tr>
						<th>ID</th>
						<th class="field2 username2">Gebruikersaam</th>
						<th class="field2 username2">Voornaam</th>
						<th class="field2 username2">Achternaam</th>
						<th class="field2 email2">E-mail</th>
						</tr>';

					foreach($data as $row)
					{
						echo '<tr>
								<td>'.$row["MemberID"].'</td>
								<td>'.$row["Username"].'</td>
								<td>'.$row["Firstname"].'</td>
								<td>'.$row["Lastname"].'</td>
								<td>'.$row["Email"].'</td>
							</tr>';
					}

					echo '</table>';
				}
				else{
					echo '<p>Er zijn geen gebruikers beschikbaar</p>';
				}

			?>
		</div>
			<p>Gebruiker toevoegen klik <a href="javascript:void(0)" onclick="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">hier.</a>
			</p>
				<div id="light" class="white_content">
					<p>Gebruiker toevoegen</p> 

					<a href="javascript:void(0)" onclick="document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">Sluit.</a>
				</div>
					<div id="fade" class="black_overlay">
					</div>
				<p>Een random stsukje tekst :D</p>
			<div id="copyright">
				<p>&copy; ScanYours-Arnhem</p>
			</div>
	</div>