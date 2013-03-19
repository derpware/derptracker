<?php

class MailProvider extends DataProvider {
	protected $name = "mail";
	
	protected function fetchData() {
		$data = array();
		
		$mbox = imap_open($this->config["mailbox"], $this->config["username"], $this->config["password"], OP_READONLY)
      or die("can't connect: " . imap_last_error());

		$quota = imap_get_quotaroot($mbox, "INBOX");
		if (is_array($quota)) {
			$storage = $quota['STORAGE'];
			$data["quota"] = array(
				"usage" => $storage['usage'],
				"limit" => $storage['limit']
			);
		}
 
		$data["inbox"] = array(
			"total" => imap_num_msg($mbox),
			"unread" => count(imap_search($mbox,'UNSEEN')),
			"recent" => imap_num_recent($mbox),
			"flagged" => count(imap_search($mbox,'FLAGGED')),
			"answered" => count(imap_search($mbox,'ANSWERED'))
		);
 
 
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
			$data["entire_mailbox"] = array(
				"total" => $count,
				"unread" => $unread,
				"recent" => $recent,
				"flagged" => $flagged,
				"answered" => $answered
			);
		} else {
			echo "imap_list failed: " . imap_last_error() . "\n";
		}
		
		$this->metadata = $data;
	}
}
