<?php
/**
 * Title: Default Footer
 * Slug: twentytwentythree/footer-default
 * Categories: footer
 * Block Types: core/template-part/footer
 */
?>

<p style="width: 200%;">Вывод всех пользователей и некоторых данных по ним (Сортировку через передачу значения переменной или поиск через передачу значения можно сделать (но чуть позже))</p>
<p style="width: 200%;">
	<?php
	//______________________________________________________ПОДКЛЮЧЕНИЕ К БД______________________________________________________
		$host = 'localhost';  // Хост, у нас все локально
		$user = 'root';    // Имя созданного вами пользователя
		$pass = ''; // Установленный вами пароль пользователю
		$db_name = 'SHODBDTEST';   // Имя базы данных
		$link = mysqli_connect($host, $user, $pass, $db_name); // Соединяемся с базой
		// Ругаемся, если соединение установить не удалось
		if (!$link) {
			echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
			exit;
		}
        else{
            echo "";
        }
	//______________________________________________________ВЫВОД ВСЕХ ПОЛЬЗОВАТЕЛЕЙ(БЕЗ ФИЛЬТРА)______________________________________________________
		$sql = "SELECT * FROM `wp_users`;";
		$result = $link->query($sql);

		if ($result->num_rows > 0) {
    		while($row = $result->fetch_assoc()) {
				$user_id = $row["ID"];
				$sql1 = "SELECT `user_coin` ,`user_total`  FROM `wp_user_coin` WHERE `user_id` = $user_id;";
				$result1 = $link->query($sql1);

        		echo $row["ID"]. " ". $row["display_name"]. " ". $row["user_nicename"]. " ". $row["class"]. " ";
				if ($result1->num_rows > 0) {
					while($row1 = $result1->fetch_assoc()) {
		
						echo $row1["user_coin"]. " " . $row1["user_total"]. " ";
					}
				} 
				else {
					echo "Данные не обнаружены ";
				}
				$user = get_user_by('id', $user_id);
				if ($user) {
					$user_roles = $user->roles;
					
					if (!empty($user_roles)) {
						foreach ($user_roles as $role) {
							$role_obj = get_role($role);
							if ($role_obj) {
								echo wp_roles()->roles[$role_obj->name]['name']. "<br>";
							}
						}
					}
				}
			} 
		}
		else {
    		echo "Данные не обнаружены <br>";
		}
	//______________________________________________________ВЫВОД ЗНАЧЕНИЙ ТЕКУЩЕГО ПОЛЬЗОВАТЕЛЯ______________________________________________________
	//______________________________________________________ФОРМА СОЗДАНИЯ/ВЫВОДА УВЕДОМЛЕНИЯ(LOG)______________________________________________________
	//______________________________________________________ФОРМА НАЧИСЛЕНИЯ сОЛЯРОВ /ВЫВОДА УВЕДОМЛЕНИЯ(LOG)______________________________________________________
	?>
	
</p>