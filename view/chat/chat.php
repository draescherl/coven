<?php $title = 'chat'; ?>
<?php ob_start(); ?>

<form name="form" action="" method="POST">
	<div class="col s12 l4 offset-l4">
		<div class="center-align">
			<div class="container">
				<div class="header">
    				<?php echo("<font size=4>Bonjour " . "<b>" .$_SESSION['username'] . "</b>" .  ", à qui voulez-vous parler ?</font>"); ?>	
				</div>		
			</div>
		</div>
	</div>

	<br>
	<br>

	<div class="center-align">
		<div class="row">
			<div class="container col s4 offset-s4">
				<b>Destinataire :</b> <br>
				<i class="material-icons prefix"></i>
        		<select name="member" id="member">
				<option value="" disabled selected>Users</option>
        		<?php
                    foreach($users as $i => $value){
                        echo('<option>'.$value->{"username"}.'</option>');
                    }
        		?>
       			</select>
			</div>	
		</div>
	</div>
	<div class="row">
		<div class="col s4 offset-s4">
			<div class="input-field">
				<i class="material-icons prefix">mode_edit</i>
            	<input id="message" name="message" type="text" class="validate">
            	<label for="message">Message</label>
    		</div>
		</div>
		<button class="btn-large waves-effect waves-light" type="submit" id="submit">
    		<i class="material-icons center">send</i>
    	</button>
	</div>

	<!-- Messages shown here -->
	<div id='messages'></div>
</form>

<script>
    $(document).ready(function(){

        $("#submit").click(function(e){
            e.preventDefault();

            $.post(
                'model/messaging/destinataire.php',
                {
                    member : $("#member").val(),
                    message : $("#message").val()
				},
				function(response) {
                    $('#messages').html(response);
                },
                'text'
            );
        });
    });
</script>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>

