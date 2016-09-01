html = '<div class="btn-group" role="group" id="navButtons" >
  <div id="scrollBack" class="button btn btn-default<% if (firstPage) { %> hidden<%}%>">back </div>
  <div id="scrollForward" class="button btn btn-default<% if (lastPage) { %> hidden<%}%>">forward</div>
  <% for(var i = 1; i <= totalPages; i++){ %>
    <div id="pageButton" page="<%- i%>" class="button btn btn-default pageButton<% if (currentPos === i) { %> active<%}%>"><%- i%></div>
  <% } %>
</div>'

module.exports = html