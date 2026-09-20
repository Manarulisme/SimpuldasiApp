/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 8.0.30 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `users` (
	`id` bigint (20),
	`name` varchar (765),
	`jabatan` varchar (300),
	`email` varchar (765),
	`email_verified_at` timestamp ,
	`password` varchar (765),
	`remember_token` varchar (300),
	`created_at` timestamp ,
	`updated_at` timestamp 
); 
insert into `users` (`id`, `name`, `jabatan`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) values('1','Admin Kelurahan','','admin@kelurahan.test',NULL,'$2y$12$ExP43i3zUItqexzkYtVYxO.Lj9cQZAuIsRFrgdNs3vzdKvsYNsTAC','bSPqWrT07hPbPAck5w1m5vvAh9E4amJO2pJ6kHNVzTVGgbdfbgmdiHUINB1L','2026-09-14 14:46:33','2026-09-14 14:46:33');
insert into `users` (`id`, `name`, `jabatan`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) values('2','Test User','Lurah','test@example.com','2026-09-15 14:48:09','$2y$12$TsOr38gTy9f14DjLsy4Qx.WGM1T1Xr0b/d1HB10gYvSu5GuFl.XIa','hHJXmf33nY','2026-09-15 14:48:09','2026-09-18 22:51:25');
insert into `users` (`id`, `name`, `jabatan`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) values('4','Lurah','Lurah','lurah@kelurahanbinong.id',NULL,'$2y$12$/2wWmSI4L5dfN3EU/Vx2I.F8dePbU1pFj9Wq9/4t26BDj1YaYbhoy',NULL,'2026-09-18 22:04:30','2026-09-18 22:04:30');
insert into `users` (`id`, `name`, `jabatan`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) values('5','Sekretaris Kelurahan','Sekretaris Kelurahan','sekretaris@kelurahanbinong.id',NULL,'$2y$12$a5nJil8iEhosVbkkbEQ1quQH2ZuY2Foum6KkwkG52JluDL6sIGWh.',NULL,'2026-09-18 22:04:30','2026-09-18 22:04:30');
insert into `users` (`id`, `name`, `jabatan`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) values('6','Kasi Pemerintahan','Kasi Pemerintahan','pemerintahan@kelurahanbinong.id',NULL,'$2y$12$XD2M/lCSi1IOK3OZSNMWCOsa1CnTUfWgJImr5gtpoV0MqLhtgej2i',NULL,'2026-09-18 22:04:30','2026-09-18 22:04:30');
insert into `users` (`id`, `name`, `jabatan`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) values('7','Kasi Kesejahteraan Sosial','Kasi Kesejahteraan Sosial','kessos@kelurahanbinong.id',NULL,'$2y$12$g8elCqHQXko6MX1mwRcXWOx8EbyiI2rkjJuZZNkqfPZ.11E0VKXYq',NULL,'2026-09-18 22:04:30','2026-09-18 22:04:30');
insert into `users` (`id`, `name`, `jabatan`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) values('8','Kasi Ekonomi Pembangunan','Kasi Ekonomi Pembangunan','ekbang@kelurahanbinong.id',NULL,'$2y$12$sO/Ivqbn6XRWhJ//yOWeG.RFiSrkZuJdaEiZ3a6GpOAphjZyS09oa',NULL,'2026-09-18 22:04:30','2026-09-18 22:51:04');
