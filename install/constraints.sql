--
-- Constraints for table `user_cookies`
--
ALTER TABLE `user_cookies` ADD CONSTRAINT `user_cookies_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
--
-- Constraints for table `user_cookies`
--
-- @TODO: ON DELETE the record should also be removed here. Also update code once this has been implemented here.
--
ALTER TABLE `user_roles` ADD CONSTRAINT `user_roles_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

