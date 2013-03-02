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
 
		$data["inbox_total"] = imap_num_msg($mbox);
		$data["inbox_unread"] = count(imap_search($mbox,'UNSEEN'));
		$data["inbox_recent"] = imap_num_recent($mbox);
		$data["inbox_flagged"] = count(imap_search($mbox,'FLAGGED'));
		$data["inbox_answered"] = count(imap_search($mbox,'ANSWERED'));
 
 
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
			$data["entire_mailbox_total"] = $count;
			$data["entire_mailbox_unread"] = $unread;
			$data["entire_mailbox_recent"] = $recent;
			$data["entire_mailbox_flagged"] = $flagged;
			$data["entire_mailbox_answered"] = $answered;
		} else {
			echo "imap_list failed: " . imap_last_error() . "\n";
		}
		return $data;
	}
}
