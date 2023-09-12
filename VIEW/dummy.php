<!DOCTYPE html>
<html>
<head>
	<title>Radio Button Example</title>
	<style>
		.block {
			display: none;
		}
	</style>
</head>
<body>
	<h2>Select an option:</h2>
	<label><input type="radio" name="option" value="option1" onclick="showBlock()">Option 1</label>
	<label><input type="radio" name="option" value="option2" onclick="showBlock()">Option 2</label>

	<div class="block" id="block1">
		<p>This is block 1.</p>
	</div>
	<div class="block" id="block2">
		<p>This is block 2.</p>
	</div>

	<script>
		function showBlock() {
			var option = document.querySelector('input[name="option"]:checked').value;
			var block = document.querySelector('#block' + option.substring(option.length - 1));
			if (block) {
				var blocks = document.querySelectorAll('.block');
				for (var i = 0; i < blocks.length; i++) {
					blocks[i].style.display = 'none';
				}
				block.style.display = 'block';
			}
		}
	</script>
</body>
</html>
