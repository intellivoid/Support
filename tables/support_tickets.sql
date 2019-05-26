create table support_tickets
(
	id INT(255) comment 'The ID of the Support Ticket',
	ticket_number VARCHAR(255) null comment 'A Unique Ticket Number used for a reference',
	source VARCHAR(255) null comment 'The source of the support ticket',
	subject VARCHAR(255) null comment 'The subject of the ticket',
	message TEXT null comment 'The message regarding the ticket',
	response_email VARCHAR(255) null comment 'The response email for the sender of this ticket',
	ticket_status INT(255) null comment 'The status of the support ticket',
	ticket_notes TEXT null comment 'Optional Administrator Notes that are attached to this ticket',
	submission_timestamp INT(255) null comment 'The Unix Timestamp of when this support ticket was submitted'
)
comment 'Table of support tickets that can be reported from various sources';

ALTER TABLE `support_tickets`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `support_tickets_id_uindex` (`id`);

ALTER TABLE `support_tickets`
	MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;