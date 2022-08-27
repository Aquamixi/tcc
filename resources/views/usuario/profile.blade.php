@extends('layouts.app')

    @section('titulo', 'MyRecipes')
    @section('conteudo')
        <main role="main">
            <div class="container p-2">
                <div class="d-flex  align-items-start">
                    <div class="container row">
                        <div class="card col-3" style="width:13.5rem; height:23rem ">   
                            <div class="card-body">
                                <div class="nav flex-column nav-pills me-3 mx-auto" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <button class="nav-link active mt-2" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true" style="height: 3.6rem; width:10rem ;">Perfil</button>
                                    <button class="nav-link mt-2" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false" style="height: 3.6rem; width:10rem ;">Minhas&nbsp;Receitas</button>
                                    <button class="nav-link mt-2" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false" style="height: 3.6rem; width:10rem ;">Receitas&nbsp;Curtidas</button>
                                    <button class="nav-link mt-2" id="v-pills-favoritas-tab" data-bs-toggle="pill" data-bs-target="#v-pills-favoritas" type="button" role="tab" aria-controls="v-pills-favoritas" aria-selected="false" style="height: 3.6rem; width:10rem ;">Receitas&nbsp;Favoritas</button>
                                    <button class="nav-link mt-2" id="v-pills-detalhes-tab" data-bs-toggle="pill" data-bs-target="#v-pills-detalhes" type="button" role="tab" aria-controls="v-pills-detalhes" aria-selected="false" style="height: 3.6rem; width:10rem ;">Detalhes&nbsp;Conta</button>
                                    <a href="{{url('amigos/' . $usuario->id)}}">Amigos</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content col-9" id="v-pills-tabContent">
                            <div class="tab-pane fade show active bg-transparent" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <div class="card mb-3" >
                                    <div class="row g-0 m-4">
                                        <div class="col-md-4 ">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRSU6xHSdzHFBr_BfjyYBYkcCf4_o_KnP5QiQ&usqp=CAU" class="img-fluid rounded-start" height="500px">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <div class="container mt-3 row">
                                                    <h5 class=" col-6 ">nome</h5>
                                                    <h5 class=" col-6 text-end">idade</h5>
                                                </div>
                                                <div class="container mt-3 row">
                                                    <h5 class="col-6">email</h5>
                                                </div>
                                                <div class="container mt-3 row">
                                                    <h5 class="col-6">Entrou Em</h5>
                                                    <h5 class=" col-6 text-end">idade</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                <div class="row col">
                                    <div class="card ms-2  mb-2 col-2" style="width: 18rem;">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDAcf_svgmVpUhJ9FPngZGcpHNN9c3MAAaBg&usqp=CAU" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                    <div class="card ms-2  mb-2 col-2" style="width: 18rem;">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDAcf_svgmVpUhJ9FPngZGcpHNN9c3MAAaBg&usqp=CAU" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                    <div class="card ms-2  mb-2 col-2" style="width: 18rem;">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDAcf_svgmVpUhJ9FPngZGcpHNN9c3MAAaBg&usqp=CAU" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                    <div class="card ms-2  mb-2 col-2" style="width: 18rem;">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDAcf_svgmVpUhJ9FPngZGcpHNN9c3MAAaBg&usqp=CAU" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                    <div class="card ms-2  mb-2 col-2" style="width: 18rem;">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDAcf_svgmVpUhJ9FPngZGcpHNN9c3MAAaBg&usqp=CAU" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                    <div class="card ms-2  mb-2 col-2" style="width: 18rem;">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDAcf_svgmVpUhJ9FPngZGcpHNN9c3MAAaBg&usqp=CAU" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                    <div class="card ms-2  mb-2 col-2" style="width: 18rem;">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDAcf_svgmVpUhJ9FPngZGcpHNN9c3MAAaBg&usqp=CAU" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                <div class="row col">
                                    <div class="card ms-2  mb-2 col-2" style="width: 18rem;">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDAcf_svgmVpUhJ9FPngZGcpHNN9c3MAAaBg&usqp=CAU" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                    <div class="card ms-2  mb-2 col-2" style="width: 18rem;">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDAcf_svgmVpUhJ9FPngZGcpHNN9c3MAAaBg&usqp=CAU" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                    <div class="card ms-2  mb-2 col-2" style="width: 18rem;">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDAcf_svgmVpUhJ9FPngZGcpHNN9c3MAAaBg&usqp=CAU" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                    <div class="card ms-2  mb-2 col-2" style="width: 18rem;">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDAcf_svgmVpUhJ9FPngZGcpHNN9c3MAAaBg&usqp=CAU" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                    <div class="card ms-2  mb-2 col-2" style="width: 18rem;">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDAcf_svgmVpUhJ9FPngZGcpHNN9c3MAAaBg&usqp=CAU" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                    <div class="card ms-2  mb-2 col-2" style="width: 18rem;">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDAcf_svgmVpUhJ9FPngZGcpHNN9c3MAAaBg&usqp=CAU" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                    <div class="card ms-2  mb-2 col-2" style="width: 18rem;">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDAcf_svgmVpUhJ9FPngZGcpHNN9c3MAAaBg&usqp=CAU" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-favoritas" role="tabpanel" aria-labelledby="v-pills-favoritas-tab">
                                <div class="row col">
                                    <div class="card ms-2  mb-2 col-2" style="width: 18rem;">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDAcf_svgmVpUhJ9FPngZGcpHNN9c3MAAaBg&usqp=CAU" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                    <div class="card ms-2  mb-2 col-2" style="width: 18rem;">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDAcf_svgmVpUhJ9FPngZGcpHNN9c3MAAaBg&usqp=CAU" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                    <div class="card ms-2  mb-2 col-2" style="width: 18rem;">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDAcf_svgmVpUhJ9FPngZGcpHNN9c3MAAaBg&usqp=CAU" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                    <div class="card ms-2  mb-2 col-2" style="width: 18rem;">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDAcf_svgmVpUhJ9FPngZGcpHNN9c3MAAaBg&usqp=CAU" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                    <div class="card ms-2  mb-2 col-2" style="width: 18rem;">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDAcf_svgmVpUhJ9FPngZGcpHNN9c3MAAaBg&usqp=CAU" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                    <div class="card ms-2  mb-2 col-2" style="width: 18rem;">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDAcf_svgmVpUhJ9FPngZGcpHNN9c3MAAaBg&usqp=CAU" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                    <div class="card ms-2  mb-2 col-2" style="width: 18rem;">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDAcf_svgmVpUhJ9FPngZGcpHNN9c3MAAaBg&usqp=CAU" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="v-pills-detalhes" role="tabpanel" aria-labelledby="v-pills-detalhes-tab">
                                <div class="card">
                                    <div class="card-body  ms-4 mt-3">
                                        <div class="input-group mb-3 row">
                                            <span class="input-group-text col-2" id="inputGroup-sizing-default">Nome:</span>
                                            <input type="text" class="form-control col-10" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="nome">
                                        </div>
                                        <div class="input-group mb-3 row">
                                            <span class="input-group-text col-2" id="inputGroup-sizing-default">E-mail:</span>
                                            <input type="text" class="form-control col-10" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="email">
                                        </div>
                                        <div class="input-group mb-3 row">
                                            <span class="input-group-text col-2" id="inputGroup-sizing-default">Senha:</span>
                                            <input type="text" class="form-control col-10" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="senha">
                                        </div>
                                        <div class="input-group mb-3 row">
                                            <span class="input-group-text col-2" id="inputGroup-sizing-default">Telefone:</span>
                                            <input type="text" class="form-control col-10" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="telefone">
                                        </div>
                                        <div class="input-group mb-3 row">
                                            <span class="input-group-text col-2" id="inputGroup-sizing-default">Data Nascimento:</span>
                                            <input type="text" class="form-control col-10" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="nascimento">
                                        </div>
                                        <div class="input-group mb-3 row">
                                            <span class="input-group-text col-2" id="inputGroup-sizing-default">Gênero:</span>
                                            <input type="text" class="form-control col-10" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="genero">
                                        </div>
                                        <div class="input-group mb-3 row">
                                            <span class="input-group-text col-2" id="inputGroup-sizing-default">Rua:</span>
                                            <input type="text" class="form-control col-10" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="rua">
                                        </div>
                                        <div class="input-group mb-3 row">
                                            <span class="input-group-text col-2" id="inputGroup-sizing-default">Número:</span>
                                            <input type="text" class="form-control col-10" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="numero">
                                        </div><div class="input-group mb-3 row">
                                            <span class="input-group-text col-2" id="inputGroup-sizing-default">Bairro:</span>
                                            <input type="text" class="form-control col-10" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="bairro">
                                        </div>
                                        <div class="input-group mb-3 row">
                                            <span class="input-group-text col-2" id="inputGroup-sizing-default">Cidade:</span>
                                            <input type="text" class="form-control col-10" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="cidade">
                                        </div>
                                        <div class="input-group mb-3 row">
                                            <span class="input-group-text col-2" id="inputGroup-sizing-default">CEP:</span>
                                            <input type="text" class="form-control col-10" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="cep">
                                        </div>
                                        <div class="input-group mb-3 row">
                                            <span class="input-group-text col-2" id="inputGroup-sizing-default">UF:</span>
                                            <input type="text" class="form-control col-10" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="uf">
                                        </div>
                                        <div class="input-group mb-3 row">
                                            <span class="input-group-text col-2" id="inputGroup-sizing-default">País:</span>
                                            <input type="text" class="form-control col-10" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="pais">
                                        </div>
                                        <div class="container text-center ">
                                            <input class="btn btn-primary col-2 border-0" type="submit" value="Salvar Alterações" style="height:50px; background-color: #ff8c00; color:white">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
        </main>
    @endsection
