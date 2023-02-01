<x-guest-layout>
    <style>
        .container {
            display: grid;
            place-items: center;
            min-height: 100vh;
            padding: 50px
        }
    </style>
    <div class="bg-gray-200">
        <div class="container">
            <div class="p-5 aligns-items-center justify-content-center bg-white shadow-xl rounded-md">
                <div class="card-body">
                    <h2 style="box-sizing: border-box; margin: 0; line-height: 1.2; font-size: 20px; letter-spacing: -0.05em; color: #576d96; padding-bottom: 20px; font-family: Montserrat, sans-serif; background-color: #ffffff;">
                        <span style="color: #576d96;">1. Termos</span></h2>
                    <p style="box-sizing: border-box; margin-top: 0; margin-bottom: 1rem; font-size: 16px; font-weight: 400; letter-spacing: normal;">
                        <span style="color: #576d96;">Ao acessar ao site <a
                                href="{{env('APP_URL')}}"><b>{{env('APP_NAME')}}</b></a>, concorda em cumprir estes termos de servi&ccedil;o, todas as leis e regulamentos aplic&aacute;veis ​​e concorda que &eacute; respons&aacute;vel pelo cumprimento de todas as leis locais aplic&aacute;veis. Se voc&ecirc; n&atilde;o concordar com algum desses termos, est&aacute; proibido de usar ou acessar este site. Os materiais contidos neste site s&atilde;o protegidos pelas leis de direitos autorais e marcas comerciais aplic&aacute;veis.</span>
                    </p>
                    <h2 style="box-sizing: border-box; margin: 0px; line-height: 1.2; font-size: 20px; letter-spacing: -0.05em; color: #576d96; padding-bottom: 20px; font-family: Montserrat, sans-serif; background-color: #ffffff;">
                        <span style="color: #576d96;">2. Uso de Licen&ccedil;a</span></h2>
                    <p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; font-weight: 400; letter-spacing: normal;">
                        <span style="color: #576d96;">&Eacute; concedida permiss&atilde;o para baixar temporariamente uma c&oacute;pia dos materiais (informa&ccedil;&otilde;es ou software) no site <b>{{env('APP_NAME')}}</b> , apenas para visualiza&ccedil;&atilde;o transit&oacute;ria pessoal e n&atilde;o comercial. Esta &eacute; a concess&atilde;o de uma licen&ccedil;a, n&atilde;o uma transfer&ecirc;ncia de t&iacute;tulo e, sob esta licen&ccedil;a, voc&ecirc; n&atilde;o pode:&nbsp;</span>
                    </p>
                    <ol style="box-sizing: border-box; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; font-weight: 400; letter-spacing: normal;">
                        <li style="box-sizing: border-box;"><span style="color: #576d96;">modificar ou copiar os materiais;&nbsp;</span>
                        </li>
                        <li style="box-sizing: border-box;"><span style="color: #576d96;">usar os materiais para qualquer finalidade comercial ou para exibi&ccedil;&atilde;o p&uacute;blica (comercial ou n&atilde;o comercial);&nbsp;</span>
                        </li>
                        <li style="box-sizing: border-box;"><span style="color: #576d96;">tentar descompilar ou fazer engenharia reversa de qualquer software contido no site <b>{{env('APP_NAME')}}</b>;</span>
                        </li>
                        <li style="box-sizing: border-box;"><span style="color: #576d96;">remover quaisquer direitos autorais ou outras nota&ccedil;&otilde;es de propriedade dos materiais; ou&nbsp;</span>
                        </li>
                        <li style="box-sizing: border-box;"><span style="color: #576d96;">transferir os materiais para outra pessoa ou 'espelhe' os materiais em qualquer outro servidor.</span>
                        </li>
                    </ol>
                    <p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; font-weight: 400; letter-spacing: normal;">
                        <span style="color: #576d96;">Esta licen&ccedil;a ser&aacute; automaticamente rescindida se voc&ecirc; violar alguma dessas restri&ccedil;&otilde;es e poder&aacute; ser rescindida por <b>{{env('APP_NAME')}}</b> a qualquer momento. Ao encerrar a visualiza&ccedil;&atilde;o desses materiais ou ap&oacute;s o t&eacute;rmino desta licen&ccedil;a, voc&ecirc; deve apagar todos os materiais baixados em sua posse, seja em formato eletr&oacute;nico ou impresso.</span>
                    </p>
                    <h2 style="box-sizing: border-box; margin: 0px; line-height: 1.2; font-size: 20px; letter-spacing: -0.05em; color: #576d96; padding-bottom: 20px; font-family: Montserrat, sans-serif; background-color: #ffffff;">
                        <span style="color: #576d96;">3. Isen&ccedil;&atilde;o de responsabilidade</span></h2>
                    <ol style="box-sizing: border-box; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; font-weight: 400; letter-spacing: normal;">
                        <li style="box-sizing: border-box;"><span style="color: #576d96;">Os materiais no site da <b>{{env('APP_NAME')}}</b> s&atilde;o fornecidos 'como est&atilde;o'. <b>{{env('APP_NAME')}}</b> n&atilde;o oferece garantias, expressas ou impl&iacute;citas, e, por este meio, isenta e nega todas as outras garantias, incluindo, sem limita&ccedil;&atilde;o, garantias impl&iacute;citas ou condi&ccedil;&otilde;es de comercializa&ccedil;&atilde;o, adequa&ccedil;&atilde;o a um fim espec&iacute;fico ou n&atilde;o viola&ccedil;&atilde;o de propriedade intelectual ou outra viola&ccedil;&atilde;o de direitos.</span>
                        </li>
                        <li style="box-sizing: border-box;"><span style="color: #576d96;">Al&eacute;m disso, o <b>{{env('APP_NAME')}}</b> n&atilde;o garante ou faz qualquer representa&ccedil;&atilde;o relativa &agrave; precis&atilde;o, aos resultados prov&aacute;veis ​​ou &agrave; confiabilidade do uso dos materiais em seu site ou de outra forma relacionado a esses materiais ou em sites vinculados a este site.</span>
                        </li>
                    </ol>
                    <h2 style="box-sizing: border-box; margin: 0px; line-height: 1.2; font-size: 20px; letter-spacing: -0.05em; color: #576d96; padding-bottom: 20px; font-family: Montserrat, sans-serif; background-color: #ffffff;">
                        <span style="color: #576d96;">4. Limita&ccedil;&otilde;es</span></h2>
                    <p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; font-weight: 400; letter-spacing: normal;">
                        <span style="color: #576d96;">Em nenhum caso o <b>{{env('APP_NAME')}}</b> ou seus fornecedores ser&atilde;o respons&aacute;veis ​​por quaisquer danos (incluindo, sem limita&ccedil;&atilde;o, danos por perda de dados ou lucro ou devido a interrup&ccedil;&atilde;o dos neg&oacute;cios) decorrentes do uso ou da incapacidade de usar os materiais em <b>{{env('APP_NAME')}}</b>, mesmo que <b>{{env('APP_NAME')}}</b> ou um representante autorizado da <b>{{env('APP_NAME')}}</b> tenha sido notificado oralmente ou por escrito da possibilidade de tais danos. Como algumas jurisdi&ccedil;&otilde;es n&atilde;o permitem limita&ccedil;&otilde;es em garantias impl&iacute;citas, ou limita&ccedil;&otilde;es de responsabilidade por danos conseq&uuml;entes ou incidentais, essas limita&ccedil;&otilde;es podem n&atilde;o se aplicar a voc&ecirc;.</span>
                    </p>
                    <h2 style="box-sizing: border-box; margin: 0px; line-height: 1.2; font-size: 20px; letter-spacing: -0.05em; color: #576d96; padding-bottom: 20px; font-family: Montserrat, sans-serif; background-color: #ffffff;">
                        <span style="color: #576d96;">5. Precis&atilde;o dos materiais</span></h2>
                    <p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; font-weight: 400; letter-spacing: normal;">
                        <span style="color: #576d96;">Os materiais exibidos no site da <b>{{env('APP_NAME')}}</b> podem incluir erros t&eacute;cnicos, tipogr&aacute;ficos ou fotogr&aacute;ficos. <b>{{env('APP_NAME')}}</b> n&atilde;o garante que qualquer material em seu site seja preciso, completo ou atual. <b>{{env('APP_NAME')}}</b> pode fazer altera&ccedil;&otilde;es nos materiais contidos em seu site a qualquer momento, sem aviso pr&eacute;vio. No entanto, <b>{{env('APP_NAME')}}</b> n&atilde;o se compromete a atualizar os materiais.</span>
                    </p>
                    <h2 style="box-sizing: border-box; margin: 0px; line-height: 1.2; font-size: 20px; letter-spacing: -0.05em; color: #576d96; padding-bottom: 20px; font-family: Montserrat, sans-serif; background-color: #ffffff;">
                        <span style="color: #576d96;">6. Links</span></h2>
                    <p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; font-weight: 400; letter-spacing: normal;">
                        <span style="color: #576d96;">O <b>{{env('APP_NAME')}}</b> n&atilde;o analisou todos os sites vinculados ao seu site e n&atilde;o &eacute; respons&aacute;vel pelo conte&uacute;do de nenhum site vinculado. A inclus&atilde;o de qualquer link n&atilde;o implica endosso por <b>{{env('APP_NAME')}}</b> do site. O uso de qualquer site vinculado &eacute; por conta e risco do usu&aacute;rio.</span>
                    </p>
                    <p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; font-weight: 400; letter-spacing: normal;">
                        &nbsp;</p>
                    <h3 style="box-sizing: border-box; margin: 0px 0px 20px; line-height: 1.2; font-size: 16px; letter-spacing: -0.05em; color: #576d96; font-family: Montserrat, sans-serif; background-color: #ffffff;">
                        <span style="color: #576d96;">Modifica&ccedil;&otilde;es</span></h3>
                    <p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; font-weight: 400; letter-spacing: normal;">
                        <span style="color: #576d96;">O <b>{{env('APP_NAME')}}</b> pode revisar estes termos de servi&ccedil;o do site a qualquer momento, sem aviso pr&eacute;vio. Ao usar este site, voc&ecirc; concorda em ficar vinculado &agrave; vers&atilde;o atual desses termos de servi&ccedil;o.</span>
                    </p>
                    <h3 style="box-sizing: border-box; margin: 0px 0px 20px; line-height: 1.2; font-size: 16px; letter-spacing: -0.05em; color: #576d96; font-family: Montserrat, sans-serif; background-color: #ffffff;">
                        <span style="color: #576d96;">Lei aplic&aacute;vel</span></h3>
                    <p style="box-sizing: border-box; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; font-weight: 400; letter-spacing: normal;">
                        <span style="color: #576d96;">Estes termos e condi&ccedil;&otilde;es s&atilde;o regidos e interpretados de acordo com as leis do <b>{{env('APP_NAME')}}</b> e voc&ecirc; se submete irrevogavelmente &agrave; jurisdi&ccedil;&atilde;o exclusiva dos tribunais naquele estado ou localidade.</span>
                    </p>


                </div>
            </div>
        </div>
    </div>
</x-guest-layout>


