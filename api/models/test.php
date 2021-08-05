Select id_user as id_friend, name, lastname, avatar, city, country from users
LEFT JOIN friend ON id_user= id_follower where id_followed 
IN(SELECT users.id_user from users INNER JOIN (select id_follower as ami from friend where id_followed=:id_user union all SELECT id_followed as ami from friend where id_follower=:id_user) as f on users.id_user= f.ami)
and id_follower <>:id_user
and id_follower not in (SELECT  users.id_user as id_friend FROM friend LEFT JOIN users ON `id_followed`=users.id_user WHERE `id_follower`= :id_user 
UNION SELECT users.id_user as id_friend FROM friend LEFT JOIN users ON `id_follower`=users.id_user WHERE `id_followed`=:id_user)
UNION
Select id_user as id_friend, name, lastname, avatar, city, country from users
LEFT JOIN friend ON id_user= id_followed where id_follower
IN (SELECT users.id_user from users INNER JOIN (select id_follower as ami from friend where id_followed=:id_user union all SELECT id_followed as ami from friend where id_follower=:id_user) as f on users.id_user= f.ami)
and id_followed <>:id_user
and id_followed not in (SELECT users.id_user as id_friend FROM friend LEFT JOIN users ON `id_followed`=users.id_user WHERE `id_follower`= :id_user
UNION SELECT users.id_user as id_friend FROM friend LEFT JOIN users ON `id_follower`=users.id_user WHERE `id_followed`=:id_user);