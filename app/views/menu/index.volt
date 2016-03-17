<?php

?>
<div class="backFoodMenu AbsBox">
    <div class="foodMenu SiteBox">
        <ul>
            {% for item in typeMenu %}
                <li>
                    <a href="{{item.href}}">
                        <img src="/public/img/{{item.image}}" alt="{{item.name}}">
                        <h4>{{item.name}}</h4>
                    </a>
                </li>
            {% endfor %}
        </ul>
        <div class="content">
            <div class="boxInfoDish">
                <div class="img">
                    <img src="/public/img/back/food1.png" alt="">
                </div>
                <div class="info">
                    <h3>name dish</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti minima nemo minus culpa ratione amet. Assumenda recusandae dicta libero nulla, vel laborum, magni explicabo ipsa facilis labore nisi sint quam.
                    </p>
                    <a href="#">to order</a>
                </div>
            </div>
            <div class="boxList">
                <h2>{{titleList}}</h2>
                <table class="table table-hover">
                    <tr>
                        <th>name dish</th>
                        <th>gramme</th>
                        <th>price</th>
                    </tr>
                    {% for item in dishList %}
                         <tr>
                            <td><p data-show="{{item.id}}" class="showDish">{{item.name_dish}}</p></td>
                            <td>{{item.weight_dish}}{{item.type_weight_dish}}</td>
                            <td>${{item.price_dish}}</td>
                        </tr>
                    {% endfor %}
                </table>
            </div>
        </div>
    </div>
</div>