    
    <div  class="hiddenRow"> 
        <div> 
            <div id="list-legal-doc-7" >
                <div class="card">
                    <div class="card-body">
                        <div class="exapand-head">
                            Datos para Firma
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <table class="legal-info-wrap">
                                    <tbody>
                                        <tr class=" row">
                                            <td class="col-lg-5 col-sm-12">
                                                <div class="user-head-wi-ico">
                                                    <i class="icon-icons-person-person"></i> Abogado:
                                                </div>
                                            </td>
                                            <td class="col-lg-7 col-sm-12">
                                                <ul class="user-legal-info">
                                                    <li class="BodyBody-2">
                                                {{$loading_details['lawyer_name']}}
                                                    </li>
                                                    <li class="BodyBody-2"> {{$loading_details['phone']}}</li>
                                                    <li class="BodyBody-2"> {{$loading_details['email']}}</li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <table class="legal-info-wrap">
                                        <tbody>
                                            <tr class=" row">
                                                <td class="col-lg-4 col-sm-12">
                                                    <div class="user-head-wi-ico">
                                                        <i class="icon-icons-pin"></i> Firmar en:
                                                    </div>
                                                </td>
                                                <td class="col-lg-8 col-sm-12">
                                                    <ul class="user-legal-info">
                                                    <li class="BodyBody-2">{{$loading_details['lawyer_address']}}
                                                        </li>
                                                        <li class="BodyBody-2">{{$loading_details['zone']}}</li>
                                                        <li class="BodyBody-2">{{$loading_details['township']}}</li>
                                                        <li class="BodyBody-2">{{$loading_details['department']}}</li>
                                                    </ul>
                                                </td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <div class="expand-note">
                                    <p class="mb-0 BodySmall-2">Los datos proporcionados son exclusivamente para ponerse en contacto con el abogado correspondiente para coordinar la legalización de su documento. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>