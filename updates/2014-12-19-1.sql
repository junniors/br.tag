CREATE or REPLACE VIEW `ataPerformance` AS
    select 
        `s`.`name` AS `school`,
        concat(`ec`.`name`, ' - ', `eu`.`acronym`) AS `city`,
        date_format(now(), '%d') AS `day`,
		date_format(now(), '%m') AS `month`,
        date_format(now(), '%Y') AS `year`,
        substring_index(`svm`.`name`, ' - ', 1) AS `ensino`,
        `c`.`name` AS `name`,
        (case `c`.`turn`
            when 'M' then 'Matutino'
            when 'T' then 'Vespertino'
            else 'Noturno'
        end) AS `turn`,
        substring_index(`svm`.`name`, ' - ', -(1)) AS `serie`,
        `c`.`school_year` AS `school_year`,
        `c`.`id` AS `classroom_id`,
        concat_ws('|',
                if((`c`.`discipline_biology` = 1),
                    'Biologia',
                    NULL),
                if((`c`.`discipline_science` = 1),
                    'Ciência',
                    NULL),
                if((`c`.`discipline_physical_education` = 1),
                    'Educação Física',
                    NULL),
                if((`c`.`discipline_religious` = 1),
                    'Ensino Religioso',
                    NULL),
                if((`c`.`discipline_philosophy` = 1),
                    'Filosofia',
                    NULL),
                if((`c`.`discipline_physics` = 1),
                    'Física',
                    NULL),
                if((`c`.`discipline_geography` = 1),
                    'Geografia',
                    NULL),
                if((`c`.`discipline_history` = 1),
                    'História',
                    NULL),
                if((`c`.`discipline_native_language` = 1),
                    'Lingua Nativa',
                    NULL),
                if((`c`.`discipline_mathematics` = 1),
                    'Matemática',
                    NULL),
                if((`c`.`discipline_pedagogical` = 1),
                    'Pedagogia',
                    NULL),
                if((`c`.`discipline_language_portuguese_literature` = 1),
                    'Português',
                    NULL),
                if((`c`.`discipline_chemistry` = 1),
                    'Química',
                    NULL),
                if((`c`.`discipline_arts` = 1),
                    'Ártes',
                    NULL),
                if((`c`.`discipline_professional_disciplines` = 1),
                    'Disciplina Proficionalizante',
                    NULL),
                if((`c`.`discipline_foreign_language_spanish` = 1),
                    'Espanhol',
                    NULL),
                if((`c`.`discipline_social_study` = 1),
                    'Estudo Social',
                    NULL),
                if((`c`.`discipline_foreign_language_franch` = 1),
                    'Francês',
                    NULL),
                if((`c`.`discipline_foreign_language_english` = 1),
                    'Inglês',
                    NULL),
                if((`c`.`discipline_informatics` = 1),
                    'Informática',
                    NULL),
                if((`c`.`discipline_libras` = 1),
                    'Libras',
                    NULL),
                if((`c`.`discipline_foreign_language_other` = 1),
                    'Outro Idioma',
                    NULL),
                if((`c`.`discipline_sociocultural_diversity` = 1),
                    'Sociedade e Cultura',
                    NULL),
                if((`c`.`discipline_others` = 1),
                    'Outras',
                    NULL)) AS `disciplines`
    from
        ((((`classroom` `c`
        join `school_identification` `s` ON ((`c`.`school_inep_fk` = `s`.`inep_id`)))
        left join `edcenso_city` `ec` ON ((`s`.`edcenso_city_fk` = `ec`.`id`)))
        left join `edcenso_uf` `eu` ON ((`s`.`edcenso_uf_fk` = `eu`.`id`)))
        left join `edcenso_stage_vs_modality` `svm` ON ((`c`.`edcenso_stage_vs_modality_fk` = `svm`.`id`)))



