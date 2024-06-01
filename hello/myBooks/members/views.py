# from django.shortcuts import render
# from django.template import loader
# # Create your views here.
# from django.http import HttpResponse
# def members(request):
#     template = loader.get_template('myfirst.html')
#     return HttpResponse(template.render())

from django.shortcuts import render

def members(request):
    return render(request, 'myfirst.html')
