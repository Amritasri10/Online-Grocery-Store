<?php
include("header.php");
if(!isset($_SESSION['staffid']))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
		//Update Statement Starts Here
		$sql="UPDATE city SET city='$_POST[city]',pincodes='$_POST[pincodes]',description='$_POST[description]',status='$_POST[status]' WHERE  city_id='$_GET[editid]'"; 
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('City updated successfully');</script>";
		}
		//Update Statement Ends Here
	}
	else
	{
	//Insert Statement Starts here
	$sql="INSERT INTO city(city,pincodes,description,status) VALUES('$_POST[city]','$_POST[pincodes]','$_POST[description]','Active')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('City Record Inserted successfully');</script>";
		echo "<script>window.location='city.php';</script>";
	}
	//Insert Statement Ends here
	}
}
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM city where city_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
	echo mysqli_num_rows($qsqledit);
}
?>
<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">City</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!-- register -->
	<div class="register">
		<div class="container">
			<h2>City</h2>
			<div class="login-form-grids">
				<h5>Enter city information</h5>
<form action="" method="post" onsubmit="return validateform()">
	
	<div class="form-group">
		City   <span id="id_city" class="err_msg"></span>
		<input type="text" name="city" id="city" placeholder="Enter city." class="form-control" value="<?php echo $rsedit['city']; ?>" >
	</div>

	<div class="form-group">
		PIN Code<br>   <span id="id_form-tags-1" class="err_msg"></span>
		<textarea name="pincodes" id="form-tags-1"  placeholder="Enter PIN code" class="form-control" style="width: 100%;" ><?php echo $rsedit['pincodes']; ?></textarea>
	</div>
	
	<div class="form-group">
		Description  <span id="id_description" class="err_msg"></span>
		<textarea name="description" id="description" placeholder="Enter Description" class="form-control" > <?php echo $rsedit['description']; ?></textarea>
	</div>                 
	
	<div class="form-group">
		Status  <span id="id_status" class="err_msg"></span>
		<select name="status" id="status" class="form-control">
			<option value="">Select Status</option>
			<?php
			$arr = array("Active","Inactive");
			foreach($arr as $val)
			{
				if($val == $rsedit['status'])
				{
				echo "<option value='$val' selected >$val</option>";
				}
				else
				{
				echo "<option value='$val'>$val</option>";
				}
			}
			?>
		</select>
	</div>
	

	<input type="submit" value="Click Here to Submit" name="submit" id="submit">
</form>
			</div>
		</div>
	</div>
<!-- //register -->
<?php
include("footer.php");
?>
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style> 
.tagsinput,.tagsinput *{box-sizing:border-box}
.tagsinput{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-flex-wrap:wrap;-ms-flex-wrap:wrap;flex-wrap:wrap;background:#fff;font-family:sans-serif;font-size:14px;line-height:20px;color:#556270;padding:15px 55px 0;border:1px solid #e6e6e6;border-radius:2px}
.tagsinput.focus{border-color:#ccc}
.tagsinput .tag{position:relative;background:#556270;display:block;max-width:100%;word-wrap:break-word;color:#fff;padding:5px 30px 5px 5px;border-radius:2px;margin:0 5px 5px 0}
.tagsinput .tag .tag-remove{position:absolute;background:0 0;display:block;width:30px;height:30px;top:0;right:0;cursor:pointer;text-decoration:none;text-align:center;color:#ff6b6b;line-height:30px;padding:0;border:0}
.tagsinput .tag .tag-remove:after,.tagsinput .tag .tag-remove:before{background:#ff6b6b;position:absolute;display:block;width:10px;height:2px;top:14px;left:10px;content:''}
.tagsinput .tag .tag-remove:before{-webkit-transform:rotateZ(45deg);transform:rotateZ(45deg)}
.tagsinput .tag .tag-remove:after{-webkit-transform:rotateZ(-45deg);transform:rotateZ(-45deg)}
.tagsinput div{-webkit-box-flex:1;-webkit-flex-grow:1;-ms-flex-positive:1;flex-grow:1}
.tagsinput div input{background:0 0;display:block;width:100%;font-size:14px;line-height:20px;padding:5px;border:0;margin:0 5px 5px 0}
.tagsinput div input.error{color:#ff6b6b}
.tagsinput div input::-ms-clear{display:none}
.tagsinput div input::-webkit-input-placeholder{color:#ccc;opacity:1}
.tagsinput div input:-moz-placeholder{color:#ccc;opacity:1}
.tagsinput div input::-moz-placeholder{color:#ccc;opacity:1}
.tagsinput div input:-ms-input-placeholder{color:#ccc;opacity:1}
</style>
<script>
	$(function() {
	$('#form-tags-1').tagsInput();

	$('#form-tags-2').tagsInput({
		'onAddTag': function(input, value) {
			console.log('PIN Code Added', input, value);
		},
		'onRemoveTag': function(input, value) {
			console.log('PIN Code Removed', input, value);
		},
		'onChange': function(input, value) {
			console.log('change triggered', input, value);
		}
	});

	$('#form-tags-3').tagsInput({
		'unique': true,
		'minChars': 2,
		'maxChars': 10,
		'limit': 5,
		'validationPattern': new RegExp('^[a-zA-Z]+$')
	});

	$('#form-tags-4').tagsInput({
		'autocomplete': {
			source: [
				'apple',
				'banana',
				'orange',
				'pizza'
			]
		}
	});

	$('#form-tags-5').tagsInput({
		'delimiter': ';'
	});

	$('#form-tags-6').tagsInput({
		'delimiter': [',', ';']
	});
});



/* jQuery Tags Input Revisited Plugin
 *
 * Copyright (c) Krzysztof Rusnarczyk
 * Licensed under the MIT license */

(function($) {
	var delimiter = [];
	var inputSettings = [];
	var callbacks = [];

	$.fn.addTag = function(value, options) {
		options = jQuery.extend({
			focus: false,
			callback: true
		}, options);
		
		this.each(function() {
			var id = $(this).attr('id');

			var tagslist = $(this).val().split(_getDelimiter(delimiter[id]));
			if (tagslist[0] === '') tagslist = [];

			value = jQuery.trim(value);
			
			if ((inputSettings[id].unique && $(this).tagExist(value)) || !_validateTag(value, inputSettings[id], tagslist, delimiter[id])) {
				$('#' + id + '_tag').addClass('error');
				return false;
			}
			
			$('<span>', {class: 'tag'}).append(
				$('<span>', {class: 'tag-text'}).text(value),
				$('<button>', {class: 'tag-remove'}).click(function() {
					return $('#' + id).removeTag(encodeURI(value));
				})
			).insertBefore('#' + id + '_addTag');

			tagslist.push(value);

			$('#' + id + '_tag').val('');
			if (options.focus) {
				$('#' + id + '_tag').focus();
			} else {
				$('#' + id + '_tag').blur();
			}

			$.fn.tagsInput.updateTagsField(this, tagslist);

			if (options.callback && callbacks[id] && callbacks[id]['onAddTag']) {
				var f = callbacks[id]['onAddTag'];
				f.call(this, this, value);
			}
			
			if (callbacks[id] && callbacks[id]['onChange']) {
				var i = tagslist.length;
				var f = callbacks[id]['onChange'];
				f.call(this, this, value);
			}
		});

		return false;
	};

	$.fn.removeTag = function(value) {
		value = decodeURI(value);
		
		this.each(function() {
			var id = $(this).attr('id');

			var old = $(this).val().split(_getDelimiter(delimiter[id]));

			$('#' + id + '_tagsinput .tag').remove();
			
			var str = '';
			for (i = 0; i < old.length; ++i) {
				if (old[i] != value) {
					str = str + _getDelimiter(delimiter[id]) + old[i];
				}
			}

			$.fn.tagsInput.importTags(this, str);

			if (callbacks[id] && callbacks[id]['onRemoveTag']) {
				var f = callbacks[id]['onRemoveTag'];
				f.call(this, this, value);
			}
		});

		return false;
	};

	$.fn.tagExist = function(val) {
		var id = $(this).attr('id');
		var tagslist = $(this).val().split(_getDelimiter(delimiter[id]));
		return (jQuery.inArray(val, tagslist) >= 0);
	};

	$.fn.importTags = function(str) {
		var id = $(this).attr('id');
		$('#' + id + '_tagsinput .tag').remove();
		$.fn.tagsInput.importTags(this, str);
	};

	$.fn.tagsInput = function(options) {
		var settings = jQuery.extend({
			interactive: true,
			placeholder: 'Add PIN Code',
			minChars: 0,
			maxChars: null,
			limit: null,
			validationPattern: null,
			width: 'auto',
			height: 'auto',
			autocomplete: null,
			hide: true,
			delimiter: ',',
			unique: true,
			removeWithBackspace: true
		}, options);

		var uniqueIdCounter = 0;

		this.each(function() {
			if (typeof $(this).data('tagsinput-init') !== 'undefined') return;

			$(this).data('tagsinput-init', true);

			if (settings.hide) $(this).hide();
			
			var id = $(this).attr('id');
			if (!id || _getDelimiter(delimiter[$(this).attr('id')])) {
				id = $(this).attr('id', 'tags' + new Date().getTime() + (++uniqueIdCounter)).attr('id');
			}

			var data = jQuery.extend({
				pid: id,
				real_input: '#' + id,
				holder: '#' + id + '_tagsinput',
				input_wrapper: '#' + id + '_addTag',
				fake_input: '#' + id + '_tag'
			}, settings);

			delimiter[id] = data.delimiter;
			inputSettings[id] = {
				minChars: settings.minChars,
				maxChars: settings.maxChars,
				limit: settings.limit,
				validationPattern: settings.validationPattern,
				unique: settings.unique
			};

			if (settings.onAddTag || settings.onRemoveTag || settings.onChange) {
				callbacks[id] = [];
				callbacks[id]['onAddTag'] = settings.onAddTag;
				callbacks[id]['onRemoveTag'] = settings.onRemoveTag;
				callbacks[id]['onChange'] = settings.onChange;
			}

			var markup = $('<div>', {id: id + '_tagsinput', class: 'tagsinput'}).append(
				$('<div>', {id: id + '_addTag'}).append(
					settings.interactive ? $('<input>', {id: id + '_tag', class: 'tag-input', value: '', placeholder: settings.placeholder}) : null
				)
			);

			$(markup).insertAfter(this);

			$(data.holder).css('width', settings.width);
			$(data.holder).css('min-height', settings.height);
			$(data.holder).css('height', settings.height);

			if ($(data.real_input).val() !== '') {
				$.fn.tagsInput.importTags($(data.real_input), $(data.real_input).val());
			}
			
			// Stop here if interactive option is not chosen
			if (!settings.interactive) return;
			
			$(data.fake_input).val('');
			$(data.fake_input).data('pasted', false);
			
			$(data.fake_input).on('focus', data, function(event) {
				$(data.holder).addClass('focus');
				
				if ($(this).val() === '') {
					$(this).removeClass('error');
				}
			});
			
			$(data.fake_input).on('blur', data, function(event) {
				$(data.holder).removeClass('focus');
			});

			if (settings.autocomplete !== null && jQuery.ui.autocomplete !== undefined) {
				$(data.fake_input).autocomplete(settings.autocomplete);
				$(data.fake_input).on('autocompleteselect', data, function(event, ui) {
					$(event.data.real_input).addTag(ui.item.value, {
						focus: true,
						unique: settings.unique
					});
					
					return false;
				});
				
				$(data.fake_input).on('keypress', data, function(event) {
					if (_checkDelimiter(event)) {
						$(this).autocomplete("close");
					}
				});
			} else {
				$(data.fake_input).on('blur', data, function(event) {
					$(event.data.real_input).addTag($(event.data.fake_input).val(), {
						focus: true,
						unique: settings.unique
					});
					
					return false;
				});
			}
			
			// If a user types a delimiter create a new tag
			$(data.fake_input).on('keypress', data, function(event) {
				if (_checkDelimiter(event)) {
					event.preventDefault();
					
					$(event.data.real_input).addTag($(event.data.fake_input).val(), {
						focus: true,
						unique: settings.unique
					});
					
					return false;
				}
			});
			
			$(data.fake_input).on('paste', function () {
				$(this).data('pasted', true);
			});
			
			// If a user pastes the text check if it shouldn't be splitted into tags
			$(data.fake_input).on('input', data, function(event) {
				if (!$(this).data('pasted')) return;
				
				$(this).data('pasted', false);
				
				var value = $(event.data.fake_input).val();
				
				value = value.replace(/\n/g, '');
				value = value.replace(/\s/g, '');
				
				var tags = _splitIntoTags(event.data.delimiter, value);
				
				if (tags.length > 1) {
					for (var i = 0; i < tags.length; ++i) {
						$(event.data.real_input).addTag(tags[i], {
							focus: true,
							unique: settings.unique
						});
					}
					
					return false;
				}
			});
			
			// Deletes last tag on backspace
			data.removeWithBackspace && $(data.fake_input).on('keydown', function(event) {
				if (event.keyCode == 8 && $(this).val() === '') {
					 event.preventDefault();
					 var lastTag = $(this).closest('.tagsinput').find('.tag:last > span').text();
					 var id = $(this).attr('id').replace(/_tag$/, '');
					 $('#' + id).removeTag(encodeURI(lastTag));
					 $(this).trigger('focus');
				}
			});

			// Removes the error class when user changes the value of the fake input
			$(data.fake_input).keydown(function(event) {
				// enter, alt, shift, esc, ctrl and arrows keys are ignored
				if (jQuery.inArray(event.keyCode, [13, 37, 38, 39, 40, 27, 16, 17, 18, 225]) === -1) {
					$(this).removeClass('error');
				}
			});
		});

		return this;
	};
	
	$.fn.tagsInput.updateTagsField = function(obj, tagslist) {
		var id = $(obj).attr('id');
		$(obj).val(tagslist.join(_getDelimiter(delimiter[id])));
	};

	$.fn.tagsInput.importTags = function(obj, val) {
		$(obj).val('');
		
		var id = $(obj).attr('id');
		var tags = _splitIntoTags(delimiter[id], val); 
		
		for (i = 0; i < tags.length; ++i) {
			$(obj).addTag(tags[i], {
				focus: false,
				callback: false
			});
		}
		
		if (callbacks[id] && callbacks[id]['onChange']) {
			var f = callbacks[id]['onChange'];
			f.call(obj, obj, tags);
		}
	};
	
	var _getDelimiter = function(delimiter) {
		if (typeof delimiter === 'undefined') {
			return delimiter;
		} else if (typeof delimiter === 'string') {
			return delimiter;
		} else {
			return delimiter[0];
		}
	};
	
	var _validateTag = function(value, inputSettings, tagslist, delimiter) {
		var result = true;
		
		if (value === '') result = false;
		if (value.length < inputSettings.minChars) result = false;
		if (inputSettings.maxChars !== null && value.length > inputSettings.maxChars) result = false;
		if (inputSettings.limit !== null && tagslist.length >= inputSettings.limit) result = false;
		if (inputSettings.validationPattern !== null && !inputSettings.validationPattern.test(value)) result = false;
		
		if (typeof delimiter === 'string') {
			if (value.indexOf(delimiter) > -1) result = false;
		} else {
			$.each(delimiter, function(index, _delimiter) {
				if (value.indexOf(_delimiter) > -1) result = false;
				return false;
			});
		}
		
		return result;
	};
 
	var _checkDelimiter = function(event) {
		var found = false;
		
		if (event.which === 13) {
			return true;
		}

		if (typeof event.data.delimiter === 'string') {
			if (event.which === event.data.delimiter.charCodeAt(0)) {
				found = true;
			}
		} else {
			$.each(event.data.delimiter, function(index, delimiter) {
				if (event.which === delimiter.charCodeAt(0)) {
					found = true;
				}
			});
		}
		
		return found;
	 };
	 
	 var _splitIntoTags = function(delimiter, value) {
		 if (value === '') return [];
		 
		 if (typeof delimiter === 'string') {
			 return value.split(delimiter);
		 } else {
			 var tmpDelimiter = '∞';
			 var text = value;
			 
			 $.each(delimiter, function(index, _delimiter) {
				 text = text.split(_delimiter).join(tmpDelimiter);
			 });
			 
			 return text.split(tmpDelimiter);
		 }
		 
		 return [];
	 };
})(jQuery);
</script>           
<script>       
function validateform()
{
	//###########
	var numericExpression = /^[0-9]+$/;
	var alphaExp = /^[a-zA-Z]+$/;
	var alphaspaceExp = /^[a-zA-Z\s]+$/;
	var alphanumbericExp = /^[0-9a-zA-Z]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	//###########
	$(".err_msg").html('');
	var validate = "true";
	//###############################################
	if($("#city").val() == "")
	{
		$('#id_city').html("City should not be empty...");
		validate = "false";
	}
	//###############################################
	if($("#form-tags-1").val() == "")
	{
		$('#id_form-tags-1').html("Pincode should not be empty...");
		validate = "false";
	}
	//###############################################
	if($("#description").val() == "")
	{
		$('#id_description').html("Description should not be empty...");
		validate = "false";
	}
	//###############################################
	if($("#status").val() == "")
	{
		$('#id_status').html("Kindly select the status...");
		validate = "false";
	}
	//###############################################
	if(validate == "true")
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>
	