from fastapi import APIRouter
import api.user as user
import api.auth as auth
import api.role as role
import api.unit as unit
import api.financial_records as financial_records

routers = [
    (auth.router, "Auth API", "/api"),
    (role.router, "Role API", "/api"),
    (user.router, "User API", "/api"),
    (unit.router, "Unit API", "/api"),
    (financial_records.router, "Financial Records API", "/api"),
]

sorted_routers = sorted(routers, key=lambda x: x[1])
router = APIRouter()
for router_instance, tag, prefix in sorted_routers:
    router.include_router(router_instance, tags=[tag], prefix=prefix)
