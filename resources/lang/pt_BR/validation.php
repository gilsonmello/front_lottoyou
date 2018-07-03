<?php

return [
    /*
      |--------------------------------------------------------------------------
      | Validation Language Lines
      |--------------------------------------------------------------------------
      |
      | The following language lines contain the default error messages used by
      | the validator class. Some of these rules have multiple versions such
      | as the size rules. Feel free to tweak each of these messages here.
      |
     */

    "accepted" => "O campo :attribute deve ser aceito.",
    "active_url" => "O campo :attribute não contém um URL válido.",
    "after" => "O campo :attribute deverá conter uma data posterior a :date.",
    "alpha" => "O campo :attribute deverá conter apenas letras.",
    "alpha_dash" => "O campo :attribute deverá conter apenas letras, números e traços.",
    "alpha_num" => "O campo :attribute deverá conter apenas letras e números .",
    "array" => "O campo :attribute precisa ser um conjunto.",
    "before" => "O campo :attribute deverá conter uma data anterior a :date.",
    "between" => [
        "numeric" => "O campo :attribute deverá ter um valor entre :min - :max.",
        "file" => "O campo :attribute deverá ter um tamanho entre :min - :max kilobytes.",
        "string" => "O campo :attribute deverá conter entre :min - :max caracteres.",
        "array" => "O campo :attribute precisar ter entre :min - :max itens.",
    ],
    "boolean" => "O campo :attribute deverá ter o valor verdadeiro ou falso.",
    "confirmed" => "A confirmação para o campo :attribute não coincide.",
    "date" => "O campo :attribute não contém uma data válida.",
    "date_format" => "A data indicada para o campo :attribute não respeita o formato :format.",
    "different" => "Os campos :attribute e :other deverão conter valores diferentes.",
    "digits" => "O campo :attribute deverá conter :digits dígitos.",
    "digits_between" => "O campo :attribute deverá conter entre :min a :max dígitos.",
    "email" => "O campo :attribute não contém um endereço de email válido.",
    "exists" => "O valor selecionado para o campo :attribute é inválido.",
    "filled" => "O campo :attribute é obrigatório.",
    "image" => "O campo :attribute deverá conter uma imagem.",
    "in" => "O campo :attribute não contém um valor válido.",
    "integer" => "O campo :attribute deverá conter um número inteiro.",
    "ip" => "O campo :attribute deverá conter um IP válido.",
    "json" => "O campo :attribute deverá conter uma string JSON válida.",
    "max" => [
        "numeric" => "O campo :attribute não deverá conter um valor superior a :max.",
        "file" => "O campo :attribute não deverá ter um tamanho superior a :max kilobytes.",
        "string" => "O campo :attribute não deverá conter mais de :max caracteres.",
        "array" => "O campo :attribute deve ter no máximo :max itens.",
    ],
    "mimes" => "O campo :attribute deverá conter um arquivo do tipo: :values.",
    "min" => [
        "numeric" => "O campo :attribute deverá ter um valor superior ou igual a :min.",
        "file" => "O campo :attribute deverá ter no mínimo :min kilobytes.",
        "string" => "O campo :attribute deverá conter no mínimo :min caracteres.",
        "array" => "O campo :attribute deve ter no mínimo :min itens.",
    ],
    "not_in" => "O campo :attribute contém um valor inválido.",
    "numeric" => "O campo :attribute deverá conter um valor numérico.",
    "regex" => "O formato do valor para o campo :attribute é inválido.",
    "required" => "O campo :attribute é obrigatório.",
    "required_if" => "O campo :attribute é obrigatório quando o valor do campo :other é igual a :value.",
    "required_with" => "O campo :attribute é obrigatório quando :values está presente.",
    "required_with_all" => "O campo :attribute é obrigatório quando um dos :values está presente.",
    "required_without" => "O campo :attribute é obrigatório quanto :values não está presente.",
    "required_without_all" => "O campo :attribute é obrigatório quando nenhum dos :values está presente.",
    "same" => "Os campos :attribute e :other deverão conter valores iguais.",
    "size" => [
        "numeric" => "O campo :attribute deverá conter o valor :size.",
        "file" => "O campo :attribute deverá ter o tamanho de :size kilobytes.",
        "string" => "O campo :attribute deverá conter :size caracteres.",
        "array" => "O campo :attribute deve ter :size itens.",
    ],
    "string" => "O campo :attribute deve ser uma string.",
    "timezone" => "O campo :attribute deverá ter um fuso horário válido.",
    "unique" => "O valor indicado para o campo :attribute já se encontra utilizado.",
    "url" => "O formato do URL indicado para o campo :attribute é inválido.",
    "cpf" => "CPF inválido.",
    "discount" => "O desconto deve ser informado em percentual ou em valor.",
    /*
      |--------------------------------------------------------------------------
      | Custom Validation Language Lines
      |--------------------------------------------------------------------------
      |
      | Here you may specify custom validation messages for attributes using the
      | convention "attribute.rule" to name the lines. This makes it quick to
      | specify a specific custom language line for a given attribute rule.
      |
     */
    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],
    /*
      |--------------------------------------------------------------------------
      | Custom Validation Attributes
      |--------------------------------------------------------------------------
      |
      | The following language lines are used to swap attribute place-holders
      | with something more reader friendly such as E-Mail Address instead
      | of "email". This simply helps us make messages a little cleaner.
      |
     */
    'attributes' => [
        'required_question_group_id' => 'Selecione ao menos 1 Grupo de Questões',
        'required_user_id' => 'Selecione ao menos 1 Usuário',
        'phone' => 'Telefone',
        'dimensions' => 'Dimensões',
        'release' => 'Lançamento',
        'stuff' => 'Material',
        'isbn' => 'ISBN',
        'edition' => 'Edição',
        'pages' => 'Páginas',
        'author_name' => 'Nome do Autor',
        'subject' => 'Assunto',
        'company_name' => 'Nome da Companhia',
        'contact' => 'Contato',
        'fone' => 'Telefone',
        'city' => 'Cidade',
        'supplier' => 'Fornecedor',
        'suppliers_id' => 'Fornecedor',
        'price_descount' => 'Preço com Desconto',
        'commission' => 'Comissão',
        'shipping_free' => 'Frete Grátis',
        'is_active' => 'Ativo',
        'state' => 'Estado',
        'country' => 'País',
        'certification_template' => 'Template do Certificado',
        'certification' => 'Certificação do Curso',
        'youtube_live_url' => 'URL',
        'courses_id' => 'Curso',
        'beginOfCourse' => 'Previsão de Ínicio',
        'name' => 'Nome',
        'formula' => 'Formula',
        'name-and-surname' => 'Nome e Sobrenome',
        'coupon_name' => 'Nome do Cupom',
        'question_limit' => 'Número máximo de vezes que o cupom poderá ser utilizado.',
        'namesurname' => 'Nome e Sobrenome',
        'email' => 'Endereço de e-mail',
        'password' => 'Senha',
        'signing' => 'Aceite dos termos',
        'add_saap' => 'Adicionar SAAP',
        'block' => 'Bloco',
        'password_confirmation' => 'Confirme sua senha',
        'old_password' => 'Senha antiga',
        'new_password' => 'Nova senha',
        'new_password_confirmation' => 'Confirme sua nova senha',
        'date' => 'Data',
        'activation_date' => 'Data de ativação',
        'image' => 'Imagem',
        'classroom_image' => 'Imagem área do aluno',
        'content' => 'Conteúdo',
        'created_at' => 'Criado em',
        'last_updated' => 'Atualizado em',
        'actions' => 'Ações',
        'active' => 'Ativo',
        'confirmed' => 'Confirmado',
        'exam' => 'SAAP',
        'date_begin' => 'Data de início',
        'date_end' => 'Data de Término',
        'send_confirmation_email' => 'Enviar E-mail de Confirmação',
        'associated_roles' => 'Papéis Associados',
        'other_permissions' => 'Outras Permissões',
        'role_name' => 'Nome do Papel',
        'sections' => 'Seção associada',
        'associated_permissions' => 'Permissões Associadas',
        'permission_name' => 'Nome da Permissão',
        'display_name' => 'Nome de Apresentação',
        'title' => 'Titulo',
        'description' => 'Descrição',
        'teacher' => 'Professor',
        'teachers' => 'Professores',
        'system_permission' => 'Permissão de sistema?',
        'code' => 'Código',
        'start_date' => 'Data inicial',
        'due_date' => 'Data de vencimento',
        'limit' => 'Limite',
        'used' => 'Usado',
        'percentage' => 'Percentagem',
        'value' => 'Valor',
        'url' => 'URL',
        'slug' => 'Slug',
        'link' => 'Link',
        'personal_id' => 'CPF',
        'birthdate' => 'Data de Nascimento',
        'cel' => 'Celular',
        'zip' => 'CEP',
        'definition' => 'Definição',
        'question' => 'Pergunta',
        'answer' => 'Resposta',
        'faqcategorys' => 'Categoria',
        'tag-cloud' => 'Exibir nuvem de tags',
        'hours_to_reply' => 'Horas para resposta',
        'message_finish' => 'Mensagem de finalização',
        'modules' => 'Módulo',
        'lessons' => 'Aula',
        'tags' => 'Tags',
        'sector' => 'Setor',
        'message' => 'Mensagem',
        'color' => 'Cor',
        'students' => 'Alunos',
        'courses' => 'Cursos',
        'course_content' => 'Conteúdo do Curso',
        'video' => 'Vídeo',
        'price' => 'Preço',
        'discount_price' => 'Preço com desconto',
        'payment' => 'Detalhes de Pagamento',
        'teachers_percentage' => 'Percentual dos professores',
        'methodology' => 'Metodologia',
        'access_time' => 'Dias para acesso',
        'workload' => 'Carga horária',
        'workload_presential' => 'Carga Horária Presencial',
        'featured' => 'Destaque',
        'special_offer' => 'Promoção',
        'subsection' => 'Subseção',
        'start_special_price' => 'Inicio Promoção',
        'end_special_price' => 'Fim Promoção',
        'special_price' => 'Preço Especial',
        'max_view' => 'Visualizações por bloco',
        'short_description' => 'Descrição curta',
        'duration' => 'Duração',
        'material' => 'Material',
        'orientation' => 'Orientação',
        'parent' => 'Pai',
        'sequence' => 'Sequência',
        'list_on_site' => 'Listar no site',
        'export_to_csv' => 'Exportar para CSV',
        'modules_name' => 'Nome da Disciplina',
        'presential' => 'Presencial',
        'complementary' => 'Complementar',
        'show_files' => 'Exibir Material de Apoio',
        'show_alert' => 'Exibir Quadro de Aviso',
        'show_calendar' => 'Exibir Calendário',
        'generate_certificate' => 'Gerar Certificado',
        'online_for_presential' => 'Presenciais disponibilizadas online',
        'max_installments' => 'Limite de Parcelas',
        'analysisexamgroups' => 'Grupo de Provas',
        'custom_workshop_title' => 'Título alternativo da Oficina',
        'your_name' => 'Seu nome',
        'your_email' => 'Seu e-mail',
        'tell-a-friend' => 'Mensagem',
        'friends' => 'Email de Amigos (separados por vírgula)',
        'certification_individual_auth'  => 'Autorização de Certificação',
        'certification_individual_text'  => 'Texto para Autorização de Certificação',
        'combo'  => 'Combo',
    ],

    'user' => [
        'create' => [
            'name' => [
                'required' => 'O campo nome é obrigatório',
                'min' => 'Informe o nome com no mínimo 3 letras',
                'regex' => 'Informe o nome somente com letras',
                'unique' => 'O Nome informado ja existe',
            ],
            'nickname' => [
                'required' => 'O campo usuário é obrigatório',
                'min' => 'Informe o usuário com no mínimo 3 letras',
                'regex' => 'Informe o usuário somente com letras',
                'unique' => 'O usuário informado já existe',
            ],
            'last_name' => [
                'required' => '',
                'min' => 'Informe o sobrenome com no mínimo 3 letras',
            ],
            'email' => [
                'required' => 'O campo e-mail é obrigatório',
                'email' => 'E-mail inválido',
                'unique' => 'E-mail já encontra-se em uso'
            ],
            'birth_day' => [
                'required' => 'O campo dia é obrigatório',
            ],
            'birth_month' => [
                'required' => 'O campo mês é obrigatório',
            ],
            'birth_year' => [
                'required' => 'O campo ano é obrigatório',
            ],
            'country' => [
                'required' => 'O campo pais é obrigatório',
            ]
        ]
    ]
];
