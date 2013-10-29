CREATE TABLE lodger
(
	ssn serial,
	lname varchar(255),
	fname varchar(255),
	mname varchar(255),
	purok varchar(255),
	barangay varchar(255),
	city varchar(255),
	province varchar(255),
	affiliation varchar(255),
	denomination varchar(255),
	startStay date,
	contactnum varchar(20),
	PRIMARY KEY (ssn)
);

CREATE TABLE room
(
	roomcode varchar(10),
	roomdesc varchar(255),
	hasCR tinyint(1),
	roomtype char(1),
	PRIMARY KEY (roomcode)
);

CREATE TABLE bedspace
(
	bedspace_id serial,
	maxspace int(2),
	monthlyrate numeric(8,2),
	PRIMARY KEY (bedspace_id)
);

CREATE TABLE payment
(
	payment_id serial,
	paymenttype varchar(255),
	amountPaid numeric(8,2),
	paymentDate date,
	PRIMARY KEY(payment_id)
);

CREATE TABLE appliancerate
(
	ar_id serial,
	appliancerate numeric(8,2),
	PRIMARY KEY (ar_id)
);

CREATE TABLE occupy_room
(
	official_rec_id serial,
	ssn bigint(20) UNSIGNED,
	rb_id bigint(20) UNSIGNED,
	ar_id bigint(20) UNSIGNED,
	PRIMARY KEY (official_rec_id),
	FOREIGN KEY (ssn) REFERENCES lodger(ssn) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (rb_id) REFERENCES room_bedspace(rb_id) ON UPDATE CASCADE ON DELETE RESTRICT
	FOREIGN KEY (ar_id) REFERENCES appliancerate(ar_id) ON UPDATE RESTRICT ON DELETE RESTRICT
);

CREATE TABLE reservation
(
	res_id serial,
    ssn bigint(20) UNSIGNED,
    rb_id bigint(20) UNSIGNED,
    resDate date,
    resDeadline date,
    PRIMARY KEY (res_id),
    FOREIGN KEY (ssn) REFERENCES lodger(ssn) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (rb_id) REFERENCES room_bedspace(rb_id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE room_bedspace
(
	rb_id serial,
	roomcode varchar(10),
	bedspace_id bigint(20) UNSIGNED,
	PRIMARY KEY (rb_id),
	FOREIGN KEY (roomcode) REFERENCES room(roomcode) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (bedspace_id) REFERENCES bedspace(bedspace_id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE lodger_payment
(
	lp_id serial,
	ssn bigint(20) UNSIGNED,
	payment_id bigint(20) UNSIGNED,
	bedspace_id bigint(20) UNSIGNED,
	ar_id bigint(20) UNSIGNED,
	PRIMARY KEY (lp_id),
	FOREIGN KEY (ssn) REFERENCES lodger(ssn) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (bedspace_id) REFERENCES bedspace(bedspace_id) ON UPDATE RESTRICT ON DELETE RESTRICT,
	FOREIGN KEY (payment_id) REFERENCES payment(payment_id) ON UPDATE CASCADE ON DELETE RESTRICT,
	FOREIGN KEY (ar_id) REFERENCES appliancerate(ar_id) ON UPDATE RESTRICT ON DELETE RESTRICT
);