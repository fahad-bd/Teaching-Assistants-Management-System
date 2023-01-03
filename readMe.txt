Documentation for CSE347 project

coverPage = Home 
massagePage = Contract


Index.html = faculty.php
Blog.html

Folder-------------
Partial folder for header and footer




Sql for add foregone key in posts table
---------------------------------------
ALTER TABLE posts ADD CONSTRAINT Fk_post_category FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE SET NULL;

ALTER TABLE posts ADD CONSTRAINT Fk_post_author FOREIGN KEY (author_id) REFERENCES users (id) ON DELETE CASCADE;

--------------------------------------------