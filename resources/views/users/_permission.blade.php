@if($user->can('employee_identity'))
<div class="identity" title="沟通科技员工">
    <i class="kticon" style="color: #0091EA;">&#xe74d;</i>
</div>
@elseif($user->can('customer_identity'))
<div class="identity" title="VIP付费用户">
    <i class="kticon" style="color: #FFD54F;">&#xe603;</i>
</div>
@elseif($user->can('parnter_identity'))
<div class="identity" title="VIP付费用户">
    <i class="kticon" style="color: #FFD54F;">&#xe603;</i>
</div>
@endif