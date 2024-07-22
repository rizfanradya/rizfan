from django.shortcuts import render
from django.http import HttpRequest


def landing_page_view(request: HttpRequest):
    extra_context = {
        'list_item': [
            {'name': 'Home', 'href': '/'},
            {'name': 'About', 'href': '#about'},
            {'name': 'Experience', 'href': '#experience'},
            {'name': 'Portfolio', 'href': '#portfolio'},
            {'name': 'Contact', 'href': '#contact'},
        ],
        'list_skill': [
            {'name': 'HTML', 'src': 'html.svg'},
            {'name': 'CSS', 'src': 'css.svg'},
            {'name': 'JAVASCRIPT', 'src': 'javascript.svg'},
            {'name': 'PYTHON', 'src': 'python.svg'},
            {'name': 'BOOTSTRAP', 'src': 'bootstrap.svg'},
            {'name': 'TAILWIND', 'src': 'tailwindcss.svg'},
            {'name': 'DJANGO', 'src': 'django.png'},
            {'name': 'FASTAPI', 'src': 'fastapi.svg'},
            {'name': 'REACTJS', 'src': 'reactjs.svg'},
            {'name': 'NODEJS', 'src': 'nodejs.svg'},
            {'name': 'EXPRESSJS', 'src': 'expressjs.png'},
            {'name': 'NEXTJS', 'src': 'nextjs.svg'},
            {'name': 'MYSQL', 'src': 'mysql.svg'},
            {'name': 'MONGODB', 'src': 'mongodb.svg'},
            {'name': 'postgresql', 'src': 'postgresql.svg'},
            {'name': 'GIT', 'src': 'git.svg'},
        ],
        'list_portfolio': [
            {
                'title': 'My Portfolio',
                'description': 'NEXTJS, TAILWINDCSS',
                'image': 'mysite.png',
                'link_site': 'https://rizfan.vercel.app/',
                'source_code': 'https://github.com/rizfanradya/rizfan',
            },
            {
                'title': 'Web Top-up Game Online & Voucher',
                'description': 'NEXTJS, TAILWINDCSS, MYSQL, MIDTRANS, APIGAMES',
                'image': 'topupgame.png',
                'link_site': 'https://topup-game-beta.vercel.app/',
                'source_code': 'https://github.com/rizfanradya/topup-game',
            },
        ]
    }
    return render(request, 'rizfan.html', extra_context)
