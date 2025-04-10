<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
	<head>
		<!--[if gte mso 9]>
		<xml>
		<o:OfficeDocumentSettings>
		<o:AllowPNG/>
		<o:PixelsPerInch>96</o:PixelsPerInch>
		</o:OfficeDocumentSettings>
		</xml>
		<![endif]-->
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="format-detection" content="date=no" />
		<meta name="format-detection" content="address=no" />
		<meta name="format-detection" content="telephone=no" />
		<meta name="x-apple-disable-message-reformatting" />
		<!--[if !mso]><!-->
		<link href="https://fonts.googleapis.com/css?family=Lato:400,400i,700,700i|Rozha+One" rel="stylesheet" />
		<!--<![endif]-->
		<title>Quotation</title>
		<!--[if gte mso 9]>
		<style type="text/css" media="all">
		sup { font-size: 100% !important; }
		</style>
		<![endif]-->
		<style type="text/css">
				table {
					width: 100% !important;
				}		
			
			@media  screen and (max-width: 480px) 
			{
				table {
					width: 100% !important;
				}
				
				
			}
		</style>
	</head>
	<body>
		<div id="Email_Quotation">
			<table width="100%">
				
				<tr>
					<td class="text" colspan="2">
						<?php echo $data->description; ?>

					</td>
				</tr>
				<tr>
					<td class="text" >
						<!--Signature-->
						<?php if($data!="" && $data->email_footer!="" && $data->email_footer!="N;"): ?>
						<?php 
$footer_id=$data->email_footer;
$footer_data=DB::table('quotation_footer')->where('id',$footer_id)->first();

						?>
				<?php if($footer_data!=''): ?>
				<?php echo $footer_data->footer_desc; ?>

			   <?php endif; ?>
						<?php endif; ?>

						
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>