# Issues

- diagrams ✔
- database ✔
- sqlconnection ✔
- navigation ✔
- templating ✔
- posts ✔
- comments ✔
- forms ✔
- login ✔
- edition ✔
- contacts ✔
- fetches ✔
- fixcomments ✔
- admin 
- security 
- bootstrap

## Issue 1 : sqlconnection

Diagrams : `/docs/diagrams`

- sequential diagram
- Model of datas
- classes diagram

## Issue 2 : sqlconnection

Database : `docs/database`

## Issue 3 : sqlconnection

Running a Sql query.

- installing Composer (and made it works)
- use of its autoload
- installing the database connection classes
- launching a query
- installing Phpcs and normalize the code
- add types of variables

## Issue 4 : DotEnv

- use types of variables and methods
- use strict_types
- reshape way to specify the classes used by Pdo (in Entity)
- install dotenv
- displace critical values in .env
- rechape sqlconnection
- phpcs
- system of navigation using ajax

## Issue 5 : Templating
- using env variables
- install Twig
- install dump for Twig
- architecture controller+service+repository+entity
- architecture + model

## Issue 6 : Posts
- reading posts from id

## Issue 7 : Comments
- reading comments from id

## Issue 8 : Forms
- user controls : login, logout, register (archi)

## Issue 9 : Login
- user controls : login, logout, register

## Issue 10 : Edition
- create article
- create comment
- edit article
- edit visibility

## Issue 11 : Contact
- save form
- todo : send by mail

## Issue 29 : Fetches
- correction source of fetches (from DbService to each repositories)
- use BaseRep

## Issue 31 : fixcomments
- publish comment without being loged
- comment in loged mode
- set publicity to 0
- improve behaviour on errors
- let see not published articles if loged as superadmin
- add publishedcomment.html (thanks message)

## Issue 12 : Admin
- comments without being loged
- display posts comments and contacts
- moderation of comments
- set visibility of posts comments and contacts

## Issue 32 : Css (bootstrap)
- use Bootstrap
- rereform all views

## Issue 37 : Codacy
- install Codacy
- apply corrections from Codacy

## Issue 38 : Ui
- révision générale de l'utilisation
- enlever les pages intermédiaires de validation
- réformer le menu
- ajout des dates et auteurs dans le fil d'articles
- ajout d'un contenu spcifique dans la home (présentation)
- correctif erreur pub not int dans save caomment

## Issue 40 : Ui2
- real comments and datas
- fix error 167 (session)
- display date of article
- catégories in articles
- reload pages instead of message panel
- fix display comment after submit
- ehance nominations

## Issue 41 : Ui3
- ehance admin
- revision system of categories (using datalist, create new categories)
- use real names
- fix errors
- menu admin active visible
- remove pages of confirmation in newPost, login and Contact
- etc.

