<?php

class MailProvider implements DataProvider {
	private $config;
	
	function __construct() {
		global $mail;
		$this->config = $mail;
	}
	
	function getName() {
		return "mail";
	}
	
	function isActive() {
		return $this->config["active"];
	}
	
	function getData() {
		$data = array();
		
		$mbox = imap_open($this->config["mailbox"], $this->config["username"], $this->config["password"], OP_READONLY)
      or die("can't connect: " . imap_last_error());

		$quota = imap_get_quotaroot($mbox, "INBOX");
		if (is_array($quota)) {
			$storage = $quota['STORAGE'];
			$data["quota_usage"] = $storage['usage'];
			$data["quota_limit"] = $storage['limit'];
		}
 
		$count = 0;
		$unread = 0;
		$recent = 0;
		$flagged = 0;
		$answered = 0;

		$list = imap_list($mbox, $this->config["mailbox"], "*");
		if (is_array($list)) {
			foreach ($list as $val) {
				imap_reopen($mbox,$val);

				$unread += count(imap_search($mbox,'UNSEEN'));
				$flagged += count(imap_search($mbox,'FLAGGED'));
				$answered += count(imap_search($mbox,'ANSWERED'));
				
				$count += imap_num_msg($mbox);
				$recent += imap_num_recent($mbox);
			}
			$data["mails_all"] = $count;
			$data["mails_unread"] = $unread;
			$data["mails_recent"] = $recent;
			$data["mails_flagged"] = $flagged;
			$data["mails_answered"] = $answered;
		} else {
			echo "imap_list failed: " . imap_last_error() . "\n";
		}
		return $data;
	}
}
