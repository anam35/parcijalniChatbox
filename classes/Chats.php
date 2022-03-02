<?php
namespace Chats;

class Chats{
	public function getInputs(){
		return "<tr style='border:1px solid black;'><form method='post'>
				<td><input type='hidden' name='last_id' value='".$_SESSION["last_id"]."'><input type='text' name='username' value='".$_SESSION["username"]."'></td>
				<td><input type='text' name='text'></td>
				<td><input type='submit' name='posalji' value='Upisi chat'></td></form>
			</tr>
			<tr><form method='post'><td colspan='3'><input type='submit' name='logout' value='logout'></form></td></tr>
		</table>";
	}
}