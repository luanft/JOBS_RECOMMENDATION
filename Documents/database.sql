/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     22/07/2015 9:47:39 SA                        */
/*==============================================================*/


drop table if exists ACCOUNT;

drop table if exists CAREER_OBJECTIVE;

drop table if exists COMPANY_SUMARY;

drop table if exists EDUCATION;

drop table if exists EXPERIENCE;

drop table if exists JOB;

drop table if exists PROFILE;

drop table if exists RESUME;

/*==============================================================*/
/* Table: ACCOUNT                                               */
/*==============================================================*/
create table ACCOUNT
(
   Account_id           int not null,
   Username             text,
   Email                text,
   Password             text,
   primary key (Account_id)
);

/*==============================================================*/
/* Table: CAREER_OBJECTIVE                                      */
/*==============================================================*/
create table CAREER_OBJECTIVE
(
   Position             text,
   Desire_Salary        int,
   Recent_Salary        int,
   Desire_location      text,
   Willing_to_relocate  boolean,
   Willing_to_travel    boolean,
   Career_objective     text,
   Resume_id            int not null,
   primary key (Resume_id)
);

/*==============================================================*/
/* Table: COMPANY_SUMARY                                        */
/*==============================================================*/
create table COMPANY_SUMARY
(
   id                   int not null,
   Account_id           int,
   Company_name         text,
   Company_description  text,
   Email                text,
   Phone                char(15),
   Fax                  char(20),
   Address              text,
   Website              char(50),
   Logo                 text,
   primary key (id)
);

/*==============================================================*/
/* Table: EDUCATION                                             */
/*==============================================================*/
create table EDUCATION
(
   Education_id         int not null,
   Level                text,
   School               text,
   Expertise            text,
   School_year          text,
   Resume_id            int,
   primary key (Education_id)
);

/*==============================================================*/
/* Table: EXPERIENCE                                            */
/*==============================================================*/
create table EXPERIENCE
(
   Resume_id            int,
   Experience_id        int not null,
   Company_name         text,
   Position             text,
   Description          text,
   Period               text,
   primary key (Experience_id)
);

/*==============================================================*/
/* Table: JOB                                                   */
/*==============================================================*/
create table JOB
(
   Job_id               int not null,
   Job_title            text,
   Location             text,
   Salary               text,
   Description          text,
   Tag                  text,
   Company_sumary_id    int,
   Requirement          text,
   Benifit              text,
   Post_date            datetime,
   Source               text,
   primary key (Job_id)
);

/*==============================================================*/
/* Table: PROFILE                                               */
/*==============================================================*/
create table PROFILE
(
   Profile_id           int not null,
   Name                 text,
   Date_of_birth        datetime,
   Gender               text,
   Marital_status       boolean,
   Place_of_birth       text,
   Hometown             text,
   Nationality          text,
   Avatar               text,
   Address              text,
   Email                text,
   Phone                char(15),
   Hobby                text,
   primary key (Profile_id)
);

/*==============================================================*/
/* Table: RESUME                                                */
/*==============================================================*/
create table RESUME
(
   Profile_id           int,
   Account_id           int,
   Experience_id        int,
   Resume_id            int not null,
   primary key (Resume_id)
);

