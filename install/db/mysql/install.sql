create table if not exists b_ad (
	ID int(18) not null auto_increment,
	ACTIVE char(1) not null default 'Y',
	AUTHOR_ID int(18),
	TIMESTAMP_X datetime not null default '0000-00-00 00:00:00',
	DATE_START datetime not null default '0000-00-00 00:00:00',
	DATE_END datetime not null default '0000-00-00 00:00:00',
	URL varchar(255) NULL,
	COUNTER int(11) not null default '0',
	TITLE varchar(255),
	DESCRIPTION text,
	IMAGE_ID int(18),
	primary key (ID));

INSERT INTO b_ad (
URL,
TITLE,
DESCRIPTION
)
VALUES 
('test1', 'Продам тест1',  'Описание продажи теста1'), 
('test2', 'Продам тест2',  'Описание продажи теста2'), 
('test3', 'Продам тест3',  'Описание продажи теста3');
