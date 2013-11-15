<?php

class SendEmail
{
	public function init()
	{
		
	}

	public function send($messageBody, $subject, $toEmail) {
		Yii::import('ext.yii-mail.YiiMailMessage');
		$message = new YiiMailMessage;
		//compose email here
		$message->setBody($messageBody, 'text/html');
		$message->subject = $subject;

		$message->addTo($toEmail);
		$message->from = Yii::app()->params->adminEmail;
		Yii::app()->mail->send($message);
	}

	public function messageResponseFeedback($receiver, $message){
		return '
		<div style="width:650px;margin:0 auto;padding-top:1px;background-color:#3683b4">
			<div style="margin-left:8px;width:642px;background-color:#fff">
				<div style="min-height:85px"><img src="http://pikemalltech.com/wp-content/uploads/2013/08/hotdeal.png"
					width="128" height="24" alt= "'. Yii::app()->name . '" title="'. Yii::app()->name . '" 
					style="float:right;margin:28px 55px 0 0"></div>
				<div style="padding:0 55px;margin:0;line-height:1.5em">
					Chào ' . $receiver . ',
					<p style="margin:15px 0"></p>
					<p style="margin:15px 0"> </p>
					<p style="margin:15px 0">'. $message .'</p>
					<p style="margin:15px 0"> </p>
					<p style="margin:15px 0">Thân,
					<br> '. Yii::app()->name .'</p>
					<p></p>
					<p></p>
				</div>
				<div style="margin:0 auto;padding:50px 0 5px 0">
				<div style="margin:0 auto;margin-bottom:10px;width:440px;min-height:1px;border-top:1px solid #f5f5f5;border-bottom:1px solid #f5f5f5"></div>
				<p style="margin:7px 0;text-align:center;font-size:11px;color:#b7b7b7">Hot deal Bách Khoa, 123 Lý Thường Kiệt, quận 10, thành phố Hồ Chí Minh</p>
				</div>
			</div>
		</div>
		';
	}

	public function emailTitleForResponeFeedback()
	{
		return "Trả lời phản hồi từ " . Yii::app()->name ;
	}
}

?>