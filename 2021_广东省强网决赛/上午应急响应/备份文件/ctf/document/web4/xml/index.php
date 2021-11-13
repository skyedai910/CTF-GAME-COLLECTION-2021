<?php
//class test{
//
//  public function __destruct()
//	{
//		//Log::DEBUG("begin notify");
//		$this->Handle(false);
//	}
//
//  final private function Handle($needSign = true)
//	{
//		$msg = "OK";
//		//当返回false的时候，表示notify中调用NotifyCallBack回调失败获取签名校验失败，此时直接回复失败
//		$result = WxpayApi::notify(array($this, 'NotifyCallBack'), $msg);
//
//
//		if($result == false){
//			$this->SetReturn_code("FAIL");
//			$this->SetReturn_msg($msg);
//			$this->ReplyNotify(false);
//			return;
//		} else {
//			//该分支在成功回调到NotifyCallBack方法，处理完成之后流程
//			$this->SetReturn_code("SUCCESS");
//			$this->SetReturn_msg("OK");
//		}
//		$this->ReplyNotify($needSign);
//	}
//
//  final public function NotifyCallBack($data)
//	{
//		$msg = "OK";
//		$result = $this->NotifyProcess($data, $msg);
//
//		if($result == true){
//			$this->SetReturn_code("SUCCESS");
//			$this->SetReturn_msg("OK");
//		} else {
//			$this->SetReturn_code("FAIL");
//			$this->SetReturn_msg($msg);
//		}
//		return $result;
//	}
//
//
//}